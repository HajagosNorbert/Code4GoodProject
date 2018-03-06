<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/JobPost.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';
include_once '../Classes/Notification.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_GET['submit'])){
    if($_SESSION["userType"] === '1'){
        Header('Location: ../Munkaado_My_Jobs.php');
        exit();   
    }
    else{
        Header('Location: ../Index.php');
        exit();
    }
}

if(($_GET["hasAcceptedJelentkezo"]) === '1'){
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}

$job = new JobPost;
$job->setId($_GET["offerId"]);
$job->deleteFromDB();

//Header('Location: ../Munkaado_My_Jobs.php');
exit();