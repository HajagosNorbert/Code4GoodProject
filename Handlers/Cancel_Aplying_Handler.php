<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/Student.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST)){
    Header('Locationa: ../Browse_Jobs.php');
    exit();
}
$user = new Student;
$user->setId($_SESSION['userId']);
$user->cancelApplying($_POST['jobIdToCancel']);

Header('Location: ../Job.php?id='.$_POST["jobIdToCancel"]);
exit();