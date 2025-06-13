<?php
session_start();
include '../../class/allclass.php';

$student = new student;

$student_id = filter_var($_POST['student_id'], FILTER_SANITIZE_STRING);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$matricno = filter_var($_POST['matricno'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$dept = filter_var($_POST['dept'], FILTER_SANITIZE_STRING);
$dept = filter_var($_POST['dept'], FILTER_SANITIZE_STRING);
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($student->student_update($student_id, $firstname, $lastname, $matricno, $email, $phone, $password, $dept) == 1) {
    db::redirect("../view-student.php");
} else {
    echo "Failed to update student.";
}
