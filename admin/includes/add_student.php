<?php
session_start();
include '../../class/allclass.php';

$student = new student;

$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$matricno = filter_var($_POST['matricno'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$dept = filter_var($_POST['dept'], FILTER_SANITIZE_STRING);
$dept = filter_var($_POST['dept'], FILTER_SANITIZE_STRING);
$password = $_POST['password'];

// Hash password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if ($student->student_reg($firstname, $lastname, $matricno, $email, $phone, $password, $dept) == 1) {
    db::redirect("../view-student.php");
} else {
    // Handle failure (you may want to redirect or show error)
    echo "Failed to add student.";
}