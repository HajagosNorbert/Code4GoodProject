<?php
include_once '../Classes/Student.php';
session_start();

if(!isset($_POST["jobIdToApply"]) or !isset($_POST["submit"])){
    Header('Locationa: ../Browse_Jobs.php');
    exit();
}
$user = Person::createPerson($_SESSION['userId']);
$user->apply($_POST['jobIdToApply']);

Header('Location: ../Job.php?id='.$_POST["jobIdToApply"]);
exit();