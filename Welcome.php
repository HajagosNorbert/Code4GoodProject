<?php
include 'Header.php';

if(!isset($_SESSION['userType'])){
    Header('Location: Index.php');
    exit();
}

echo'<h1>'.$_SESSION["numberOfJobsPosted"].'</h1>';

?>
<?php include 'Footer.php'?>

