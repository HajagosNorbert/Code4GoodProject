<?php
include 'Header.php';


if(!isset($_SESSION['user'])){
    Header('Location: Index.php');
    exit();
}

?>
<?php include 'Footer.php'?>

