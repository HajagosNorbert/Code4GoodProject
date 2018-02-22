<?php
include 'Database_Connection.php';
session_start();

if(!isset($_POST["jobIdToAply"]) or !isset($_POST["submit"])){
    Header('Locationa: ../Browse_Jobs.php');
    exit();
}

$sqlSetAply = 'INSERT INTO ajanlatokra_jelentkezesek(jelentkezo_id, ajanlat_id, elfogadva) VALUES ("'.$_SESSION['id'].'" , "'.$_POST["jobIdToAply"].'" , "0");';
$sqlApy = mysqli_query($con, $sqlSetAply);

array_push($_SESSION['jobsAplyingFor'] , $_POST["jobIdToAply"]);

Header('Location: ../Job.php?id='.$_POST["jobIdToAply"]);
exit();

?>