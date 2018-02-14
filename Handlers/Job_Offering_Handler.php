<?php
session_start();
include 'Database_Connection.php';

if(!isset($_POST['submit'])){
    Header('Location: ../Welcome.php');
    exit();
}

if($_SESSION['numberOfJobsPosted'] >= 3){
    Header('Location: ../Welcome.php');
    exit();
}

$stmt = mysqli_stmt_init($con);
mysqli_query($con , "SET NAMES 'utf8';");

$oraszam = (int) ($_POST['oraszam']);
$cim = mysqli_real_escape_string($con, $_POST['cim']);
$leiras = mysqli_real_escape_string($con, $_POST['leiras']);
$helyszin = mysqli_real_escape_string($con, $_POST['helyszin']);
//$elvaras = mysqli_real_escape_string($_POST['elvaras']);

$sqlPostJob = " INSERT INTO ajanlatok (munkaado_id, felajanlott_oraszam, cim, leiras, helyszin) VALUES (?,?,?,?,?);";
$paramTypes = "iisss";

if(!mysqli_stmt_prepare($stmt, $sqlPostJob)){
    echo '<br><br><br><br><br><br><h1>SQL STATEMENT PREPARE ERROR</h1>';
}
else{
    mysqli_stmt_bind_param($stmt , $paramTypes, $_SESSION['id'], $oraszam, $cim, $leiras, $helyszin);
    mysqli_stmt_execute($stmt); 
}
