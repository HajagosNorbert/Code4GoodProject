<?php
include 'Database_Connection.php';
session_start();

if(!isset($_POST["aplyingIdToCancel"]) or !isset($_POST["submit"])){
    Header('Locationa: ../Browse_Jobs.php');
    exit();
}

$aplyingIdToCancel = $_POST["aplyingIdToCancel"];

$sqlCancelAplying = 'DELETE FROM ajanlatokra_jelentkezesek WHERE id = "'.$aplyingIdToCancel.'";';
mysqli_query($con, $sqlCancelAplying);

$jobIdToCancelIndex = array_search($_POST["jobIdToCancel"] , $_SESSION["jobsAplyingFor"]);
unset($_SESSION["jobsAplyingFor"][$jobIdToCancelIndex]);
Header('Location: ../Job.php?id='.$_POST["jobIdToCancel"]);
exit();

?>