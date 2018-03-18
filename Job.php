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
$owner->setAllFromDB();

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

if(isset($_SESSION['userId'])){
    if($user->userType === '0' && (!$job->isAccepted || $job->acceptedStudentId === $_SESSION['userId'])){
        //Jelentkezni
        $user->setApplyingJobIdsFromDB();
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
    
    if($user->userType === '1' && $owner->id === $user->id){
        
        ?>
            <br><br><br><br>
            <h3>Jelentkezők:</h3>

        <?php
        if(count($job->applicantIds) === 0){
            ?>
            <h4>Nincs</h4>
            <?php
        }
        else{
            //megbízott Diák
            if($job->isAccepted){
                $applicant = $job->getAcceptedStudent();
                $applicant->setAllFromDB();
                ?>
                    <h2>Megbízva: <?= $applicant->lastName?> <?= $applicant->firstName?></h2>
                    <form action="Handlers/Cancel_Accepted_Applicant_Handler.php" method="POST">
                        <input type="submit" name="submit" value="visszavonás">
                        <input type="hidden" name="JobPostId" value="<?= $job->id?>"> 
                    </form>
                <?php
                unset($applicant);
            }

            
            foreach($job->applicantIds as $applicantId){
                $applicant = Person::createPerson($applicantId);
                $applicant->setAllFromDB();
                $ratings = $applicant->getRatingValues();
                $numberOfRatings = count($ratings);
                if($numberOfRatings === 0){
                    $ratingText = 'Nincs értékelve';
                }
                else{
                    $ratingAverage = array_sum($ratings) / $numberOfRatings;
                    $ratingText = $ratingAverage.'/5 , Dolgozott '.$numberOfRatings.' alakalommal';
                }

                ?>  <br>
                    <p><?= $applicant->lastName?> <?= $applicant->firstName?></p>
                    <p>Értékelés: <?= $ratingText ?></p>
                    <?php
                    if(!$job->isAccepted){
                        ?>
                        <form method="POST" action="Handlers/Accept_Applicant_Handler.php">
                            <input type="submit" name="submit" value="Alkalmaz">
                            <input type="hidden" name="jobId" value="<?= $job->id ?>">
                            <input type="hidden" name="applicantId" value="<?= $applicant->id ?>">   
                        </form>
                <?php
                    }
                unset($applicant);
            }
            
        }
    }
}

include 'Footer.php';
?>