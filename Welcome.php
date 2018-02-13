<?php
include 'Header.php';

if(!isset($_SESSION['userType'])){
    Header('Location: Index.php');
    exit();
}
else{
}

?>
<?php include 'Footer.php'?>

