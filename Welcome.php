<?php
include 'Header.php';


if(!isset($_SESSION['userId'])){
    Header('Location: Index.php');
    exit();
}
echo($_SESSION['userId']);
?>
<?php include 'Footer.php'?>

