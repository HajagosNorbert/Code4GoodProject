<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/Student.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST["jobIdToApply"]) or !isset($_POST["submit"])){
    Header('Location: ../Browse_Jobs.php');
    exit();
}
$user = new Student;
$user->setId($_SESSION['userId']);
$user->apply($_POST['jobIdToApply']);

Header('Location: ../Job.php?id='.$_POST["jobIdToApply"]);
exit();