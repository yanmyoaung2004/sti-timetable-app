<?php
// require "db.class.php";
class dept extends db
{
    public function add_dept($dept_title)
    {
        $query = PARENT::p("INSERT INTO department VALUES (NULL, ?, ?)");
        return $query->execute([$dept_title, PARENT::now()]);
    }

    public function list_dept()
    {
        $query = PARENT::p("SELECT * FROM department ORDER BY dept_title ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function update_dept($dept_id, $dept_title)
    {
        $query = PARENT::p("UPDATE department SET dept_title = ? WHERE dept_id = ?");
        return $query->execute([$dept_title, $dept_id]);
    }

    public function delete_dept($dept_id)
    {
        $query = PARENT::p("DELETE FROM department WHERE dept_id = ?");
        return $query->execute([$dept_id]);
    }

    public function get_dept($dept)
    {
        $query = PARENT::p("SELECT * FROM `department` WHERE dept_id = ?");
        $query->execute([$dept]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function add_level($level)
    {
        $query = PARENT::p("INSERT INTO level VALUES (NULL, ?)");
        return $query->execute([$level]);
    }

    public function list_level()
    {
        $query = PARENT::p("SELECT * FROM level ORDER BY level_id ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete_level($level_id)
    {
        $query = PARENT::p("DELETE FROM level WHERE level_id = ?");
        return $query->execute([$level_id]);
    }

    public function get_level($level)
    {
        $query = PARENT::p("SELECT * FROM `level` WHERE level_id = ?");
        $query->execute([$level]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>