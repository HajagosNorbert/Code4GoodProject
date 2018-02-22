<?php
include 'Header.php';

$jobId = $_GET["id"];
if(!isset($jobId)){
    Header('Location: Browse_Jobs.php');
    exit();
}


$sqlGetJob = 'SELECT * FROM ajanlatok WHERE id = "'.$jobId.'" ;';
$sqlJob = mysqli_query($con , $sqlGetJob);

if(mysqli_num_rows($sqlJob) === 0){
    Header('Location: Browse_Jobs.php');
    exit();
}

$jobPost = mysqli_fetch_assoc($sqlJob);

//elvan-e fogadva az ajánlat diáknak
$sqlGetIsJobAccepted = 'SELECT elfogadva FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = "'.$jobPost["id"].'" ;';
$sqlIsJobAccepted = mysqli_query($con , $sqlGetIsJobAccepted);
$isJobAccepted = mysqli_fetch_assoc($sqlIsJobAccepted) === 0;

//a jelenlegi felhasználó jelenkezése a munkára
$sqlGetAlpying = 'SELECT * FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = "'.$_SESSION["id"].'" AND ajanlat_id ="'.$jobPost["id"].'" ;';
$sqlAplying = mysqli_query($con , $sqlGetAlpying);
$aplying = mysqli_fetch_assoc($sqlAplying);
$alreadyAlpied = mysqli_fetch_assoc($sqlAplying) === 0;

$sqlGetMunkaado = "SELECT * FROM felhasznalok WHERE id = '".$jobPost["munkaado_id"]."' ;";
$sqlMunkaado = mysqli_query($con , $sqlGetMunkaado);
$munkaado = mysqli_fetch_assoc($sqlMunkaado);

echo'
<br><br><br><br><br><br><br><br><br>
<h1>'.$jobPost["cim"].'</h1>
<h1>Munkaidő: '.$jobPost["felajanlott_oraszam"].' óra</h1>
<p>'.$jobPost["leiras"].'</p>
<p>Mikorra: '.$jobPost["munka_idopont"].'</p>  
<p>Itt: '.$jobPost["helyszin"].'</p>
<p>Feltette: '.$munkaado["vezeteknev"].' '.$munkaado["keresztnev"].'</p>
<p>Telefonszám: '.$munkaado["telefonszam"].'</p>';

//ha jelentkezhet az ajánlatra
if($_SESSION["userType"] === '0' && !$isJobAccepted){
    if(!in_array($jobPost['id'] , $_SESSION['jobsAplyingFor'])){
         echo'  <form action="Handlers/Aplying_Handler.php" method="POST">
        <input type="submit" name="submit" value="Jelentkezek!">
        <input type="hidden" name="jobIdToAply" value="'.$jobPost['id'].'">
        </form>';
    }
    else if(in_array($jobPost['id'] , $_SESSION['jobsAplyingFor'])){
        echo'  <form action="Handlers/Cancel_Aplying_Handler.php" method="POST">
        <input type="submit" name="submit" value="Jelenkezés megszakitása">
        <input type="hidden" name="aplyingIdToCancel" value="'.$aplying['id'].'">
        <input type="hidden" name="jobIdToCancel" value="'.$jobPost['id'].'">
        </form>';
    }
 
}
else if(in_array($jobPost['id'] , $_SESSION['jobsAplyingFor'])){
echo'<p>Már jelentkeztél</p>';
}

include 'Footer.php';
?>
