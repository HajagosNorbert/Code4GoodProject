<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/JobPost.php';
include_once '../Classes/Employer.php';
include_once '../Classes/Validator.php';

if(!isset($_POST['submit'])){
    if(isset($_SESSION["userId"])){
        Header('Location: ../Welcome.php');
        exit();
    }
    else{
        Header('Location: ../index.php');
        exit();
    }
}

$user = new Employer;
$user->setId($_SESSION['userId']);

if( count($user->jobPostIds) >= 3){
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}

$offeredHours = (int) ($_POST['oraszam']);
$title = $_POST['cim'];
$description = $_POST['leiras'];
$location = $_POST['helyszin'];
$uploadedAt = date("Y-m-d H:i:s");
$appointment = date("Y-m-d H:i:s", strtotime($_POST['munkaIdopont']));
$ownerId = $_SESSION['userId'];

$validator = new Validator;

$uploadedAtInSec = strtotime($uploadedAt);
$appointmentInSec = strtotime($appointment);
$diffInDates = $appointmentInSec - $uploadedAtInSec;

echo $appointment;
if($diffInDates <= 2 * 3600){
    $validator->addError("appointmentTooEarly");
}
if($title === ""){
    $validator->addError("titleNotValid");    
}

if($location === ""){
    $validator->addError("locationNotValid");    
}

if($validator->hasError){
    Header('Location: ../Job_Offering.php?'.$validator->getErrorUrlParams());
    exit();
}
else{
    $job = new JobPost;
    $job->create($offeredHours, $title, $description, $location, $uploadedAt, $appointment, $ownerId);
    print_r($job);
    $job->upload();

    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
    
}