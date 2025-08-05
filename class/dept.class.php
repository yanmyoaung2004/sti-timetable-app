<?php
// Ensure this class is in the correct file and your DB connection class is working

class dept extends db
{
    // ----------------- Department Functions ------------------

    public function add_dept($dept_title)
    {
        $query = PARENT::p("INSERT INTO department (dept_title, created_at) VALUES (?, ?)");
        return $query->execute([$dept_title, PARENT::now()]);
    }

    public function get_dept($dept_id)
    {
        $query = PARENT::p("SELECT * FROM `department` WHERE `dept_id`=?");
        $query->execute([$dept_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    

    public function list_dept()
    {
        $query = PARENT::p("SELECT * FROM department ORDER BY dept_title ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete_dept($dept_id)
    {
        $query = PARENT::p("DELETE FROM department WHERE dept_id = ?");
        return $query->execute([$dept_id]);
    }

    // ----------------- Level Functions ------------------

    public function add_level($level)
    {
        $query = PARENT::p("INSERT INTO level (level) VALUES (?)");
        return $query->execute([$level]);
    }

    public function list_level()
    {
        $query = PARENT::p("SELECT * FROM level ORDER BY level_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_level_by_id($level_id)
    {
        $query = PARENT::p("SELECT * FROM level WHERE level_id = ?");
        $query->execute([$level_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function update_level($level_id, $level)
    {
        $query = PARENT::p("UPDATE level SET level = ? WHERE level_id = ?");
        return $query->execute([$level, $level_id]);
    }

    public function delete_level($level_id)
    {
        $query = PARENT::p("DELETE FROM level WHERE level_id = ?");
        return $query->execute([$level_id]);
    }
}
?>