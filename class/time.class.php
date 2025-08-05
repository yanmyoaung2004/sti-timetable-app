<?php
class time extends db
{

    public function add_time($str, $end, $hour)
    {
        $query = PARENT::p("INSERT INTO `time` (`start_time`, `end_time`, `hours`, `time_added_date`) VALUES (?, ?, ?, NOW())");
        return $query->execute([$str, $end, $hour]);
    }


    public function list_time()
    {
        $query = PARENT::p("SELECT * FROM `time` ORDER BY time_id DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function del_time($time_id)
    {
        $query = PARENT::p("DELETE FROM `time` WHERE `time_id`=?");
        return $query->execute([$time_id]);
    }

    public function list_day()
    {
        $query = PARENT::p("SELECT * FROM `day` ORDER BY day_name ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function add_schedule($course, $venue, $day, $time, $session, $semester)
    {
        $check = PARENT::p("SELECT * FROM `alloc_slots` WHERE room_id=? AND day_id=? AND time_id=? AND session_id=? AND semester_id=?");
        $check->execute([$venue, $day, $time, $session, $semester]);

        $get = PARENT::p("SELECT * FROM `course` WHERE course_id=?");
        $get->execute([$course]);
        $row = $get->fetch(PDO::FETCH_OBJ);

        $check1 = PARENT::p("SELECT * FROM alloc_slots 
            LEFT JOIN course ON alloc_slots.course_id=course.course_id 
            WHERE course.dept_id=? AND course.level_id=? 
            AND alloc_slots.day_id=? AND alloc_slots.time_id=? 
            AND alloc_slots.session_id=? AND alloc_slots.semester_id=?");
        $check1->execute([$row->dept_id, $row->level_id, $day, $time, $session, $semester]);

        if ($check->rowCount() > 0) {
            return 3;
        } elseif ($check1->rowCount() > 0) {
            return 4;
        } else {
            $query = PARENT::p("INSERT INTO `alloc_slots` VALUES (NULL,?,?,?,?,?,?,?)");
            return $query->execute([$course, $venue, $day, $time, $semester, $session, PARENT::now()]);
        }
    }

    public function list_schedule($session, $semester)
    {
        $query = PARENT::p("SELECT * FROM `alloc_slots` 
            LEFT JOIN course ON alloc_slots.course_id=course.course_id 
            LEFT JOIN rooms ON alloc_slots.room_id=rooms.room_id
            LEFT JOIN day ON alloc_slots.day_id=day.day_id
            LEFT JOIN semester ON alloc_slots.semester_id=semester.semester_id
            LEFT JOIN session ON alloc_slots.session_id=session.session_id
            LEFT JOIN `time` ON alloc_slots.time_id=`time`.time_id
            WHERE alloc_slots.session_id=? AND alloc_slots.semester_id=? 
            ORDER BY alloc_id DESC");
        $query->execute([$session, $semester]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_schedule($dept, $session, $semester, $level, $time, $day)
    {
        $query = PARENT::p("SELECT * FROM `alloc_slots` 
            LEFT JOIN course ON `alloc_slots`.`course_id`=`course`.`course_id` 
            LEFT JOIN rooms ON alloc_slots.room_id=rooms.room_id
            WHERE `course`.`dept_id`=? AND session_id=? AND `alloc_slots`.semester_id=? 
            AND `course`.level_id=? AND `alloc_slots`.time_id=? AND `alloc_slots`.day_id=?");
        $query->execute([$dept, $session, $semester, $level, $time, $day]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function del_schedule($alloc_id)
    {
        $query = PARENT::p("DELETE FROM `alloc_slots` WHERE `alloc_id`=?");
        return $query->execute([$alloc_id]);
    }

    public function schedule_checker($time, $day, $lecturer_id)
    {
        $query = PARENT::p("SELECT * FROM lecturer 
            LEFT JOIN assigned_course ON lecturer.lecturer_id=assigned_course.lecturer_id 
            LEFT JOIN course ON assigned_course.course_id=course.course_id 
            LEFT JOIN alloc_slots ON assigned_course.course_id = alloc_slots.course_id
            LEFT JOIN rooms ON alloc_slots.room_id = rooms.room_id
            WHERE lecturer.lecturer_id=? AND day_id=? AND time_id=?");
        $query->execute([$lecturer_id, $day, $time]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function get_day_id($day)
    {
        $query = PARENT::p("SELECT * FROM day WHERE day_name = ?");
        $query->execute([$day]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? $result->day_id : null;
    }

    public function get_time_id($time)
    {
        $query = PARENT::p("SELECT * FROM time WHERE start_time = ?");
        $query->execute([$time]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? $result->time_id : null;
    }

    public function get_current_time_slot()
    {
        date_default_timezone_set("Africa/Lagos");
        $current_hour = date('H');
        $current_minute = date('i');
        $current_time_minutes = ($current_hour * 60) + $current_minute;

        $query = PARENT::p("SELECT * FROM `time` ORDER BY time_id ASC");
        $query->execute();
        $time_slots = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($time_slots as $slot) {
            $start_parts = explode(':', $slot->start_time);
            $start_minutes = ($start_parts[0] * 60) + $start_parts[1];

            $end_parts = explode(':', $slot->end_time);
            $end_minutes = ($end_parts[0] * 60) + $end_parts[1];

            if ($current_time_minutes >= $start_minutes && $current_time_minutes < $end_minutes) {
                return $slot;
            } elseif ($current_time_minutes < $start_minutes) {
                return $slot;
            }
        }

        return null;
    }


    public function get_time_by_id($id)
    {
        $query = PARENT::p("SELECT * FROM `time` WHERE time_id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>