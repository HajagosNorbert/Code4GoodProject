<?php  
session_start();

unset($_SESSION['email']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['userType']);
unset($_SESSION['id']);
unset($_SESSION['oraszam']);

Header('Location: ../Index.php');