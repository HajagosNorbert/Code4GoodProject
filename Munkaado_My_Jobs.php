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

<ul class="alt 5u 10u$(small) inner">
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
    <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">
        <li class="box">
            <div>
                <h2>
                    <?= $post->title ?>
                </h2>
                <h1>
                    Munkaidő:
                    <?= $post->offeredHours ?> óra
                </h1>
<!--
                <p>
                    Feltéve: <?= $post->uploadedAt ?>
                </p>
-->
                <p>
                    Mikorra: <?= $post->appointment ?>
                </p>
                <p>
                    <?= $applicantStatus ?>
                </p>
            </div>
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
        </li>
    </a>

<br>
    
        <?php
        }

    }
?>
<?php
}

if($activeJobs <3){
    $offerJobLink = '<a class="button special" href="Job_Offering.php">Ajánlj Munkát ('.$activeJobs.'/3)</a><br>';
}
else{
    $offerJobLink = '<h3>Maximum 3 ajánlatod lehet</h3>';
}
echo $offerJobLink;

?>
</ul>

<?php 
include 'Footer.php';
?>