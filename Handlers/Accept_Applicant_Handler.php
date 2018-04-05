<?php
include_once '../Classes/Dbh.php';
include_once '../Classes/JobPost.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';
include_once '../Classes/Notification.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!(isset($_SESSION['userId']) && isset($_POST))){
    Header('Location: ../Welcome.php');
    exit();
}
else{
//    try{
        $user = new Employer;
        $user->setId($_SESSION['userId']);  
        $user->setJobPostIdsFromDB();
        if(!in_array($_POST['jobId'], $user->jobPostIds)){
            Header('Location: ../Welcome.php');
            exit();
        }
        
        $job = new JobPost;
        $job->setId($_POST['jobId']);
        $job->setAllFromDB();
        $job->setAcceptedStudentId($_POST['applicantId']);
        $job->uploadAcceptedApplying();
        
        $notification = new Notification;
        $notification->setNotifiedUserId($job->acceptedStudentId);
        $notificationTitle = "Megbízást kaptál!";
        $notification->setTitle($notificationTitle);
        $notificationContent = "Te kaptad a megbízást a(z) ".$job->title." munkára";
        $notification->setContent($notificationContent);
        $notification->upload();
        Header('Location: ../Job.php?id='.$job->id);
        exit();
//    } 
//    catch (Exception $e){
//        Header('Location: ../Welcome.php');
//        exit();
//    }
}