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
$owner->setProfileImageName();

$profileImageSrc = "Uploads/Images/".$owner->profileImageName."?".mt_rand();

if(!isset($owner->phoneNumber)){
    $phoneNumber = "Nincs beállítva";
} else {
    $phoneNumber = $owner->phoneNumber;
}
?>
<!--INFÓ A POSZTRÓL-->

<div class="inner 7u 10u(medium) 12u$(small) box" >
    <ul class="alt">
        <li>
            <div class="align-center">
                <h3><?= $job->title ?></h3>
            </div>
        </li>
        <li>
            <div class="inner 12u 10u(medium)  10u$(small)">
                <div class="row">
                    <div class="12u$  12u(medium) 10u$(small)">
                        <?= $job->description ?>
                    </div>
                    <div class="6u 5u(medium) 10u$(small)">
                        <div class="12u 10u(medium) 10u$(small)">
                            Munkaidő: <b><?= $job->offeredHours ?></b> óra
                        </div>
                        <div class="12u 12(medium) 10u$(small)">
                            Mikorra: <?= $job->appointment ?>
                        </div>
                        <div class="12u 12u(medium) 10u(small)">
                            Itt: <?= $job->location ?>
                        </div>
                        <div class="12u$ 12u$(medium) 10u$(small)">   
                            Telefonszám: <?= $phoneNumber ?>
                        </div>
                    </div>
                    <div class="6u$ 7u(medium) 10u$(small)">
                        <div class="12u$  14u(medium) 10u$(small)">
                            Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a>
                        </div>
                        <div class="4u$ 4u$(medium) 8u$(small)">   
                            <span class="image fit">
                                <img src="<?= $profileImageSrc ?>" >    
                            </span>
                        </div>
                    </div>
                </div>

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
    
//    AMIT A MUNKAADÓ LÁT
    
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
                    <?php
                    if(!$job->isExpired){
                    ?>
                    <form action="Handlers/Cancel_Accepted_Applicant_Handler.php" method="POST">
                        <input type="submit" class="special fit" name="submit" value="Megbízás visszavonása">
                        <input type="hidden" name="JobPostId" value="<?= $job->id?>"> 
                    </form>  
                    <?php
                    }
                else{
                
                    ?>
                    <form action="Rate.php" method="POST">
                        <input type="submit" class="special fit" name="submit" value="Diák értékelése"> 
                        <input type="hidden" name="ratedId" value="<?= $applicant->id ?>">                        
                        <input type="hidden" name="jobId" value="<?= $job->id ?>">
                     </form>
                    <?php 
                }
                ?>
                </div>
        </div>
        </li>
    </ul>
</div>
                <?php
                unset($applicant);
            }

            if(!$job->isExpired){
                
            
        ?>
            <div class="inner 8u 8u$(small) align-center">
            <h3>Jelentkezők:</h3>
                <ul class="alt">

        <?php
            
            foreach($job->applicantIds as $applicantId){
                $applicant = new Student;
                $applicant->setId($applicantId);
                $applicant->setAllFromDB();
                $applicant->setProfileImageName();
                $profileImageSrc = "Uploads/Images/".$applicant->profileImageName."?".mt_rand();

                
                $ratingAverage = $applicant->getRatingAverageFromDB();
                if($ratingAverage === 0){
                    $ratingText = 'Még nem végzett el munkát';
                }
                else{
                    
                    $ratingText = 'Értékelés: '.$ratingAverage.'/5 , Dolgozott '.$applicant->numberOfRatings.' alakalommal';
                }

                ?> 
                    <li>
                        <div class="row">
                            <div class="2u 4u(medium) 8u$(small)">
                                <span class="image fit">
                                    <img src="<?= $profileImageSrc ?>">
                                </span>
                            </div>
                            <div class="8u 4u(medium) 8u$(small)">
                                <div class="12u 8u(medium) 8u$(small)">
                                    <a href="Profile.php?id=<?= $applicant->id?>"><?= $applicant->lastName?> <?= $applicant->firstName?></a>
                                </div>
                                <div class="12u 8u(medium) 8u$(small)">
                                    <?= $ratingText ?>
                                </div>
                            </div>
                        </div>
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
}

include 'Footer.php';
?>