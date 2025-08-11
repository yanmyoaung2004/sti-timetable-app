<?php
if (!class_exists('timetable')) {
    class timetable extends db
    {
        // Get timetable for a student based on level and department
        public function get_timetable_for_student($level_id, $dept_id)
        {
            $sql = "
                SELECT 
                    d.day_name AS day,
                    CONCAT(t.start_time, ' - ', t.end_time) AS time,
                    c.course_title AS course_name,
                    CONCAT(l.lecturer_firstname, ' ', l.lecturer_lastname) AS lecturer_name,
                    r.room_title AS room_name
                FROM alloc_slots a
                INNER JOIN course c ON a.course_id = c.course_id
                INNER JOIN day d ON a.day_id = d.day_id
                INNER JOIN time t ON a.time_id = t.time_id
                INNER JOIN rooms r ON a.room_id = r.room_id
                LEFT JOIN assigned_course ac ON c.course_id = ac.course_id
                LEFT JOIN lecturer l ON ac.lecturer_id = l.lecturer_id
                WHERE c.level_id = ? AND c.dept_id = ?
                ORDER BY a.day_id, a.time_id
            ";
            $stmt = PARENT::p($sql);
            $stmt->execute([$level_id, $dept_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Get all timetable entries (for admin/overview)
        public function get_all_timetables()
        {
            $sql = "
                SELECT 
                    d.day_name AS day,
                    CONCAT(t.start_time, ' - ', t.end_time) AS time,
                    c.course_title AS course_name,
                    CONCAT(l.lecturer_firstname, ' ', l.lecturer_lastname) AS lecturer_name,
                    r.room_title AS room_name
                FROM alloc_slots a
                INNER JOIN course c ON a.course_id = c.course_id
                INNER JOIN day d ON a.day_id = d.day_id
                INNER JOIN time t ON a.time_id = t.time_id
                INNER JOIN rooms r ON a.room_id = r.room_id
                LEFT JOIN assigned_course ac ON c.course_id = ac.course_id
                LEFT JOIN lecturer l ON ac.lecturer_id = l.lecturer_id
                ORDER BY a.day_id, a.time_id
            ";
            $stmt = PARENT::p($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>
