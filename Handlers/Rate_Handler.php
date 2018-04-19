<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';
include_once '../Classes/Student.php';
include_once '../Classes/Rating.php';
include_once '../Classes/JobPost.php';
include_once '../Classes/Notification.php';

if(!isset($_POST['submit'])){
    Header('Location: ../index.php');
    exit();
}

$rating = new Rating;

$rating->setRatedUserId($_POST['ratedUserId']);
$rating->setRaterUserId($_POST['raterUserId']);
$rating->setValue($_POST['rateValue']);
$rating->setComment($_POST['comment']);
$rating->upload();
  
$rater = Person::createPerson($rating->raterUserId);
$rater->setAllFromDB();

if(isset($_POST['jobId'])){
    
    $job = new JobPost;
    $job->setId($_POST['jobId']); 
    $job->setIsFinished(1);
    $job->uploadFinished();
    
    $noti = new Notification;
    $noti->setNotifiedUserId($rating->ratedUserId);
    $noti->setTitle("Értékeltek!");
    $noti->setContent($rater->lastName." ".$rater->firstName." véleményezte munkádat és kaptál tőle ".$rating->value." csillagot!_".$rating->raterUserId);
    $noti->upload();
}

if(isset($_POST['notificationId'])){
    $location = "Kill_Notification_Handler.php?notificationId=".$_POST['notificationId'];
    Header("Location: ".$location);
    exit();
}


Header('Location: ../Welcome.php');
exit();