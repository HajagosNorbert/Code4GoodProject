<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../Classes/Dbh.php';
include_once '../Classes/Person.php';
include_once '../Classes/Employer.php';
include_once '../Classes/Student.php';
include_once '../Classes/Notification.php';

if(!isset($_SESSION['userId'])){
    Header('Location: ../index.php');
    exit();
}

if(!isset($_GET)){
    Header('Location: ../index.php');
    exit();    
}
$notificationId = $_GET['notificationId'];

$user = Person::createPerson($_SESSION['userId']);
$user->setNotificationIds();

if(!in_array($notificationId , $user->notificationIds)){
    Header('Location: ../index.php');
    exit();    
}

$notification = new Notification;
$notification->setId($notificationId);
$notification->deleteFromDB();

Header('Location: ../Notificationes.php');