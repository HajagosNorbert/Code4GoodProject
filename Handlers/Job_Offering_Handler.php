<?php
session_start();
include 'Database_Connection.php';

/*
if(!isset($_POST['submit'])){
    if($_SESSION["user"] === '1'){
        Header('Location: ../Munkaado_My_Jobs.php');
        exit();
    }
    else{
        Header('Location: ../Index.php');
        exit();
    }
}

if($_SESSION['numberOfJobsPosted'] >= 3){
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}
*/

$stmt = mysqli_stmt_init($con);
mysqli_query($con , "SET NAMES 'utf8';");

$oraszam = (int) ($_POST['oraszam']);
$cim = mysqli_real_escape_string($con, $_POST['cim']);
$leiras = mysqli_real_escape_string($con, $_POST['leiras']);
$helyszin = mysqli_real_escape_string($con, $_POST['helyszin']);
$feltoltve = $date = date('Y-m-d H:i'); 
$munkaIdopont = mysqli_real_escape_string($con, $_POST['munkaIdopont']);

$sqlPostJob = " INSERT INTO ajanlatok (munkaado_id, felajanlott_oraszam, cim, leiras, helyszin, feltoltve, munka_idopont) VALUES (?,?,?,?,?,?,?);";
$paramTypes = "iisssss";

if(!mysqli_stmt_prepare($stmt, $sqlPostJob)){
    echo '<br><br><br><br><br><br><h1>SQL STATEMENT PREPARE ERROR</h1>';
}
else{
    
    mysqli_stmt_bind_param($stmt , $paramTypes, $_SESSION['id'], $oraszam, $cim, $leiras, $helyszin, $feltoltve, $munkaIdopont);
    mysqli_stmt_execute($stmt); 
    $_SESSION['numberOfJobsPosted']++;
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}
