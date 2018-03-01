<?php
include '../Classes/Authentication.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST['submit'])){
    Header('Location: ../Index.php');
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$login = new Login;

if($login->autherize($email , $password)){ 
    Header('Location: ../Welcome.php');
    exit();    
}
else{
    Header('Location: ../Login.php');
    exit();
}