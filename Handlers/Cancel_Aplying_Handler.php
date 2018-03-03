<?php
include_once '../Classes/Student.php';
session_start();

if(!isset($_POST["jobIdToCancel"]) or !isset($_POST["submit"])){
    Header('Locationa: ../Browse_Jobs.php');
    exit();
}
$user = Person::createPerson($_SESSION['userId']);
$user->cancelApplying($_POST['jobIdToCancel']);

Header('Location: ../Job.php?id='.$_POST["jobIdToCancel"]);
exit();