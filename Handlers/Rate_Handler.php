<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/Rating.php';
include_once '../Classes/JobPost.php';

if(!isset($_POST['submit'])){
    Header('Location: ../index.php');
    exit();
}

$rating = new Rating;

$rating->setRatedUserId($_POST['ratedUserId']);
$rating->setRaterUserId($_POST['raterUserId']);
$rating->setValue($_POST['rateValue']);
$rating->setComment($_POST['comment']);
    
if(isset($_POST['jobId'])){
    
    $job = new JobPost;
    $job->setId($_POST['jobId']); 
    $job->setIsFinished(1);
    $job->uploadFinished();
}


$rating->upload();
Header('Location: ../Welcome.php');
exit();