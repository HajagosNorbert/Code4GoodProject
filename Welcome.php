<?php
include 'Header.php';


if(!isset($_SESSION['userId'])){
    Header('Location: Index.php');
    exit();
}
?>
<?php include 'Footer.php'?>

