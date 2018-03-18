<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';
include_once '../Classes/JobPost.php';

if(!isset($_POST['submit'])){
    Header('Location: ../Index.php');
    exit();
}

if(!isset($_SESSION['userId'])){
    Header('Location: ../Index.php');    
    exit();
}

$jobPostId = $_POST['JobPostId'];

$user = New Employer;
$user->setId($_SESSION['userId']);
$user->setJobPostIdsFromDB();

if(!in_array($jobPostId , $user->jobPostIds)){
    Header('Location: ../Index.php');   
    exit();
}

$job = new JobPost;
$job->setId($jobPostId);
$job->setIsAccepted(FALSE);
$job->uploadAcceptedApplying();
Header('Location: ../Job.php?id='.$job->id);
exit();