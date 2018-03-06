<?php  
include_once '../Classes/Dbh.php';
include_once '../Classes/Authentication.php';

$login = new Login;
$login->logOut();