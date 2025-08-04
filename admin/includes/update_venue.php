<?php
include '../../class/allclass.php';

$room = new room();

$room_id = filter_var($_POST['room_id'], FILTER_SANITIZE_NUMBER_INT);
$room_title = filter_var($_POST['room_title'], FILTER_SANITIZE_STRING);
$room_capacity = filter_var($_POST['room_capacity'], FILTER_SANITIZE_NUMBER_INT);

echo $room->update_room($room_id, $room_title, $room_capacity);
?>