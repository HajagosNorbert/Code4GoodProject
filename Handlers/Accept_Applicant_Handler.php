<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/JobPost.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!(isset($_SESSION['userId']) && isset($_POST))){
    Header('Location: ../Welcome.php');
    exit();
}
else{
    try{
        $user = new Employer;
        $user->setId($_SESSION['userId']);  
        $user->setJobPostIdsFromDB();
        if(!in_array($_POST['jobId'], $user->jobPostIds)){
            Header('Location: ../Welcome.php');
            exit();
        }
        
        $job = new JobPost;
        $job->setId($_POST['jobId']);
        $job->setAcceptedStudentId($_POST['applicantId']);
        $job->uploadAcceptedApplying();
        Header('Location: ../Job.php?');
        exit();
    } 
    catch (Exception $e){
        Header('Location: ../Welcome.php');
        exit();
    }
}