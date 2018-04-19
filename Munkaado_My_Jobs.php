<?php 
include_once 'Header.php';
include_once 'Classes/BrowseJobs.php';
include_once 'Classes/JobPost.php';
if($user->userType !== '1'){
    Header('Location: index.php');
    exit();
}
?>

<?php
$postBrowser = new BrowseJobs;
$postIds = $postBrowser->getAllPostIds('WHERE munkaado_id ="'.$user->id.'"');
$activeJobs = 0;


?>
<h2 class="align-center">
    Ajánlataim
</h2>

<hr class="major">
<?php
if(empty($postIds)){
    echo'<h2>Nincs ajánlatod</h2>';
}
else{
    $posts = array();
    foreach ($postIds as $postId){
        $job = new JobPost;
        $job->setId($postId);
        $job->setAllFromDB();
        $job->setApplicantIdsFromDB();
        $posts[] = $job;
    }
    
    $user->setJobPostIdsFromDB();
    ?>

<div class="row inner">
<?php
foreach($posts as $post){
    if(!$post->isFinished){
        $activeJobs += 1;
        if($post->isAccepted){
            $acceptedStudent = $post->getAcceptedStudent();
            $acceptedStudent->setAllFromDB();
            $applicantStatus = 'Elfogadta: '.$acceptedStudent->lastName.' '.$acceptedStudent->firstName;
        }
        else if(count($post->applicantIds) === 0){
            $applicantStatus = 'Nincs jelenkező';
        }   
        else{
            $applicantStatus = 'Jelentkezők: '.count($post->applicantIds); 
        }

        ?>
        <div class="4u 6u(medium) 12u$(small)">
            <div class="box">
                <ul class="alt">
                    <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">

                        <li>
                            <h3><?= $post->title ?></h3>
                        </li>
                        <li>
                            <p>Munkaidő: <?= $post->offeredHours ?> óra</p>
                            <p>Mikorra: <?= $post->appointment ?></p>
                            <p><?= $applicantStatus ?></p>
                        </li>
                        

                        <?php
                        if(!$post->isExpired){
                        ?>
                        <form method="GET" action="Handlers/Job_Offer_Delete_Handler.php">
                            <input type="submit" name="submit" value="Visszavonás">
                            <input type="hidden" name=offerId value="<?= $post->id ?>">
                            <input type="hidden" name=hasAcceptedJelentkezo value="<?= $post->isAccepted ?>">
                        </form>
                        <?php
                        }
                        else if($post->isAccepted){
                            ?>
                            <b>Az ajánlat kitörléséhez előbb értékeld a diákot! </b>
                            <?php
                        }
                        ?>
                    </a>
                </ul>
            </div>
        </div>
    
        <?php
        }

    }
?>
</div>
<?php
}

if($activeJobs <3){
    $offerJobLink = '<a class="button special" href="Job_Offering.php">Ajánlj Munkát ('.$activeJobs.'/3)</a><br>';
}
else{
    $offerJobLink = '<h3>Maximum 3 ajánlatod lehet</h3>';
}
echo '<div class="align-center">'.$offerJobLink.'</div>';

?>

<?php 
include 'Footer.php';
?>