<?php
// require "db.class.php";
class room extends db
{
    public function add_room($room, $capacity)
    {
        $query = PARENT::p("INSERT INTO `rooms` VALUES (NULL, ?, ?)");
        return $query->execute([$room, $capacity]);
    }

    public function list_room()
    {
        $query = PARENT::p("SELECT * FROM `rooms` ORDER BY room_id DESC");
        $query->execute();
        return $row = $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function update_room($room_id, $room, $capacity)
    {
        $query = PARENT::p("UPDATE `rooms` SET `room_title` = ?, `capacity` = ? WHERE `room_id` = ?");
        return $query->execute([$room, $capacity, $room_id]);
    }

    public function filter_assigned_venue($session, $semester)
    {
        $query = PARENT::p("SELECT * FROM `rooms` WHERE `room_id` ORDER BY room_id DESC");
        $query->execute();
        return $row = $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_all_possible_schedule()
    {
        $query = PARENT::p("SELECT * FROM `rooms` LEFT JOIN time ORDER BY room_id DESC");
        $query->execute();
        return $row = $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function del_room($room_id)
    {
        $query = PARENT::p("DELETE FROM `rooms` WHERE `room_id` = ?");
        return $query->execute([$room_id]);
    }
}
?>