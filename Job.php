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
$job->setApplicantIdsFromDB();
$owner = $job->getOwner();
$owner->setAllFromDB();

if(!isset($owner->phoneNumber)){
    $phoneNumber = "Nincs beállítva";
} else {
    $phoneNumber = $owner->phoneNumber;
}
?>

<div class="inner 7u 12u$(small) box" >
    <ul class="alt">
        <li>
            <div class="align-center">
                <h3><?= $job->title ?></h3>
                <h1>Munkaidő: <?= $job->offeredHours ?> óra</h1>
            </div>
        </li>
        <li>
            <div class="inner 12u 10u$(small)">
        <p><?= $job->description ?></p>
        <p>Mikorra: <?= $job->appointment ?></p>  
        <p>Itt: <?= $job->location ?></p>
        <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
        <p>Telefonszám: <?= $phoneNumber ?></p>

<?php
//ha jelentkezhet az ajánlatra

if(isset($_SESSION['userId'])){
    if($user->userType === '0' && (!$job->isAccepted || $job->acceptedStudentId === $_SESSION['userId'])){
        //Jelentkezni
        $user->setApplyingJobIdsFromDB();
        if(!in_array($job->id , $user->applyingJobIds)){
            ?>

            <form action="Handlers/Aplying_Handler.php" method="POST">
                <input type="submit" class="fit special" name="submit" value="Jelentkezek!">
                <input type="hidden" name="jobIdToApply" value="<?= $job->id ?>">
            </form>
        <?php
        }
        
        //Megszakítani a jelentkezést
        else if(in_array($job->id , $user->applyingJobIds)){
            ?>
            <form action="Handlers/Cancel_Aplying_Handler.php" method="POST">
                <input type="submit" class="fit" name="submit" value="Jelenkezés megszakitása">
                <input type="hidden" name="jobIdToCancel" value="<?= $job->id ?>">
            </form>
            <?php
        }
    } 
    
    if($user->userType === '1' && $owner->id === $user->id){
        
        if(count($job->applicantIds) === 0){
            ?>
            <h3>Nincs</h3>
            <?php
        }
        else{
            //megbízott Diák
            if($job->isAccepted){
                $applicant = $job->getAcceptedStudent();
                $applicant->setAllFromDB();
                ?>
                <div class="row">
                    <h2>Megbízva: <a href="Profile.php?id=<?= $applicant->id?>"><?= $applicant->lastName?> <?= $applicant->firstName?></a></h2>
                    <form action="Handlers/Cancel_Accepted_Applicant_Handler.php" method="POST">
                        <input type="submit" class="special fit" name="submit" value="Megbízás visszavonása">
                        <input type="hidden" name="JobPostId" value="<?= $job->id?>"> 
                    </form>
                </div>
        </div>
        </li>
    </ul>
</div>
                <?php
                unset($applicant);
            }

        ?>
            <div class="inner 5u 8u$(small) align-center">
            <h3>Jelentkezők:</h3>
                <ul class="alt">

        <?php
            
            foreach($job->applicantIds as $applicantId){
                $applicant = new Student;
                $applicant->setId($applicantId);
                $applicant->setAllFromDB();
                $ratingAverage = $applicant->getRatingAverageFromDB();
                if($ratingAverage === 0){
                    $ratingText = 'Nincs értékelve';
                }
                else{
                    
                    $ratingText = $ratingAverage.'/5 , Dolgozott '.$applicant->numberOfRatings.' alakalommal';
                }

                ?> 
                    <li>
                        <a href="Profile.php?id=<?= $applicant->id?>"><?= $applicant->lastName?> <?= $applicant->firstName?></a>
                        <p>Értékelés: <?= $ratingText ?></p>

                        <?php
                            if(!$job->isAccepted){
                        ?>

                        <form method="POST" action="Handlers/Accept_Applicant_Handler.php">
                            <input type="submit" name="submit" value="Alkalmaz">
                            <input type="hidden" name="jobId" value="<?= $job->id ?>">
                            <input type="hidden" name="applicantId" value="<?= $applicant->id ?>">   
                        </form>
                    </li>
                <?php
                    }
                unset($applicant);
            }
            ?>
                </ul>
            </div>
            <?php
        }
    }
}

include 'Footer.php';
?>