<?php
session_start();
include_once '../Classes/JobPost.php';
include_once '../Classes/Employer.php';

if(!isset($_POST['submit'])){
    if(isset($_SESSION["userId"])){
        Header('Location: ../Welcome.php');
        exit();
    }
    else{
        Header('Location: ../Index.php');
        exit();
    }
}

$user = Person::createPerson($_SESSION['userId']);

if( count($user->jobPostIds) >= 3){
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}

$offeredHours = (int) ($_POST['oraszam']);
$title = $_POST['cim'];
$description = $_POST['leiras'];
$location = $_POST['helyszin'];
$uploadedAt = date('Y-m-d H:i'); 
$appointment = $_POST['munkaIdopont'];
$ownerId = $_SESSION['userId'];

$job = new JobPost;
$job->createNewJobPost($offeredHours, $title, $description, $location, $uploadedAt, $appointment, $ownerId);

Header('Location: ../Munkaado_My_Jobs.php');
exit();