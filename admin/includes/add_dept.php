<?php
include '../../class/allclass.php';

$dept = new dept();

$dept_title = filter_var($_POST['department'], FILTER_SANITIZE_STRING);

echo $dept->add_dept($dept_title);
?>