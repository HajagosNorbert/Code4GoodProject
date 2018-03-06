<?php
include_once 'Header.php';
include_once 'Classes/JobPost.php';


$jobId = $_GET["id"];
if(!isset($jobId)){
    Header('Location: Browse_Jobs.php');
    exit();
}

$job = new JobPost;
$job->setId($jobId);
$job->setAllFromDB();
$owner = $job->getOwner();
 
if(!$job->id){
    Header('Location: Browse_Jobs.php');
    exit();
}

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

//ha jelentkezhet az ajánlatra
if($user->userType === '0' && !$job->isAccepted){
    
    //Jelentkezni
    if(!in_array($job->id , $user->applyingJobIds)){
        ?>

        <form action="Handlers/Aplying_Handler.php" method="POST">
        <input type="submit" name="submit" value="Jelentkezek!">
        <input type="hidden" name="jobIdToApply" value="<?= $job->id ?>">
        </form>

    <?php
    }
    //Megszakítani a jelentkezést
    else if(in_array($job->id , $user->applyingJobIds)){
        ?>
        <form action="Handlers/Cancel_Aplying_Handler.php" method="POST">
        <input type="submit" name="submit" value="Jelenkezés megszakitása">
        <input type="hidden" name="jobIdToCancel" value="<?= $job->id ?>">
        </form>
    <?php
    }
 
}

include 'Footer.php';
?>
