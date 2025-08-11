<?php
class student extends db
{
    public function student_reg($fname, $lname, $matric, $email, $phone, $password, $dept) 
    {
        // Check if student already exists by matric number
        $query1 = PARENT::p("SELECT * FROM student WHERE student_matricno = ?");
        $query1->execute([$matric]);
    
        if ($query1->rowCount() > 0) {
            return 3; // Account exists
        } 
    
        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert with correct column names
        $query = PARENT::p("
            INSERT INTO student 
            (student_firstname, student_lastname, student_matricno, student_email, student_phone, student_dept_id, student_password, student_type, date_student_created)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
    
        // Execute insert
        return $query->execute([
            $fname,
            $lname,
            $matric,
            $email,
            $phone,
            $dept,              // department ID
            $hashed_password,   // password hash
            0,                  // assuming 0 for student_type by default
            PARENT::now()       // current datetime
        ]);
    }
    
    public function list_student()
    {
        $query = PARENT::p("SELECT * FROM `student` 
                            LEFT JOIN department ON student.student_dept_id=department.dept_id 
                            ORDER BY student_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function student_login($user, $pass)
    {
        $query = PARENT::p("SELECT * FROM student WHERE student_matricno=?");
        $query->execute([$user]);

        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_OBJ);

            // If stored password is MD5 hash
            if (strlen($row->student_password) == 32) {
                if (md5($pass) === $row->student_password) {
                    $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                    $update = PARENT::p("UPDATE student SET student_password=? WHERE student_id=?");
                    $update->execute([$new_hash, $row->student_id]);

                    $_SESSION['student_id'] = $row->student_id;
                    $_SESSION['student_matric'] = $row->student_matricno;
                    $_SESSION['student_dept'] = $row->student_dept_id;
                    $_SESSION['student_type'] = $row->student_type;
                    unset($_SESSION['login_error']);
                    echo "<script>window.location.href='dashboard.php'</script>";
                } else {
                    $_SESSION['login_error'] = "Incorrect Password";
                }
            } else {
                if (password_verify($pass, $row->student_password)) {
                    $_SESSION['student_id'] = $row->student_id;
                    $_SESSION['student_matric'] = $row->student_matricno;
                    $_SESSION['student_dept'] = $row->student_dept_id;
                    $_SESSION['student_type'] = $row->student_type;
                    unset($_SESSION['login_error']);
                    echo "<script>window.location.href='dashboard.php'</script>";
                } else {
                    $_SESSION['login_error'] = "Incorrect Password";
                }
            }
        } else {
            $_SESSION['login_error'] = "Incorrect Username";
        }
    }

    public function del_student($student_id)
    {
        $query = PARENT::p("DELETE FROM `student` WHERE `student_id`=?");
        return $query->execute([$student_id]);
    }

    public function add_semester($semester)
    {
        $query = PARENT::p("INSERT INTO semester VALUES (NULL,?,?)");
        return $query->execute([$semester, PARENT::now()]);
    }

    public function list_semester()
    {
        $query = PARENT::p("SELECT * FROM `semester` ORDER BY semester_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete_semester($semester_id)
    {
        $query = PARENT::p("DELETE FROM `semester` WHERE `semester_id`=?");
        return $query->execute([$semester_id]);
    }

    public function check_student()
    {
        if (!(isset($_SESSION['student_type']))) {
            $_SESSION['check_error'] = "You need to be logged in";
            echo "<script>window.location.href='../index.php'</script>";
        } else {
            if ($_SESSION['student_type'] != 0) {
                $_SESSION['check_error'] = "You are not a student";
                header("Location: dashboard.php");
                exit;
            }
        }
    }

    // UPDATED: Now returns department info + level info
    public function get_student_by_id($student_id)
    {
        $sql = "SELECT s.*, 
                       d.dept_title, 
                       lv.level_id, 
                       lv.level
                FROM student s
                LEFT JOIN department d ON s.student_dept_id = d.dept_id
                LEFT JOIN level lv ON lv.level_id = (
                    SELECT c.level_id 
                    FROM course c 
                    WHERE c.dept_id = s.student_dept_id 
                    LIMIT 1
                )
                WHERE s.student_id = ?";
        $query = PARENT::p($sql);
        $query->execute([$student_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>
