<?php
include_once 'Header.php';
include_once 'Classes/JobPost.php';
include_once 'Classes/Employer.php';


$jobId = $_GET["id"];
if(!isset($jobId)){
    Header('Location: Browse_Jobs.php');
    exit();
}

$job = new JobPost($jobId);
$owner = $job->getOwner();
 
if(!$job->id){
    Header('Location: Browse_Jobs.php');
    exit();
}


/*
//a jelenlegi felhasználó jelenkezése a munkára
$sqlGetAlpying = 'SELECT * FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = "'.$_SESSION["id"].'" AND ajanlat_id ="'.$jobPost["id"].'" ;';
$sqlAplying = mysqli_query($con , $sqlGetAlpying);
$aplying = mysqli_fetch_assoc($sqlAplying);
$alreadyAlpied = mysqli_fetch_assoc($sqlAplying) === 0;

$sqlGetMunkaado = "SELECT * FROM felhasznalok WHERE id = '".$jobPost["munkaado_id"]."' ;";
$sqlMunkaado = mysqli_query($con , $sqlGetMunkaado);
$munkaado = mysqli_fetch_assoc($sqlMunkaado);
*/
?>
<br><br><br><br><br><br><br><br><br>
<h1><?= $job->title ?></h1>
<h1>Munkaidő: <?= $job->offeredHours ?> óra</h1>
<p><?= $job->description ?></p>
<p>Mikorra: <?= $job->appointment ?></p>  
<p>Itt: <?= $job->location ?></p>
<p>Feltette: <?= $owner->lastName ?> <?= $owner->firstName ?></p>
<p>Telefonszám: <?= $owner->phoneNumber ?></p>

<?php
/*
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
*/

include 'Footer.php';
?>
