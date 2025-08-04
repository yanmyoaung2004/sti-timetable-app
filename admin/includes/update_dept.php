<?php
include '../../class/allclass.php';

$dept = new dept();

$dept_id = filter_var($_POST['dept_id'], FILTER_SANITIZE_NUMBER_INT);
$dept_title = filter_var($_POST['department'], FILTER_SANITIZE_STRING);

echo $dept->update_dept($dept_id, $dept_title);
?>