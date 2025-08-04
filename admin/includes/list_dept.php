<?php
include '../../class/allclass.php';

$dept = new dept();

$list_dept = $dept->list_dept();
echo json_encode($list_dept);
?>