<?php
include_once 'Header.php';
include_once 'Classes/BrowseJobs.php';
include_once 'Classes/JobPost.php';

if(!isset($user)){
    Header('Location: Index.php');
    exit();
}

if($user->userType === '1'){
    Header('Location: Munkaado_My_Jobs.php');
    exit();   
}
$userApplied = "";
$userNotApplied = 'AND jelentkezo_id != "'.$_SESSION['userId'].'"';
    
$condition = 'WHERE id IN (SELECT ajanlat_id FROM ajanlatokra_jelentkezesek WHERE (jelentkezo_id = '.$user->id.' ))';

$jobBrowser = new BrowseJobs;
$allPostIds = $jobBrowser->getAllPostIds($condition);
$allPosts = array();
if ($allPostIds === 0){
    echo '<h2>Nincs munka, amire jelentkezel</h2>';
}
else{
    
foreach ($allPostIds as $postId){
    $jobPost = new JobPost;
    $jobPost->setId($postId);
    $jobPost->setAllFromDB();
    $jobPost->setApplicantIdsFromDB();
    $allPosts[] = $jobPost;
}
?>
<div class="inner 6u 8u$(small) align-center">
    <h3>Munkák, amikre jelentkeztél</h3>
</div>
<ul class="alt inner 5u 10u$(small)">
<?php
foreach($allPosts as $post){
    if($post->isAccepted){
    
        $owner = $post->getOwner();
        $owner->setAllFromDB();

        ?>

        <div class="box" >
            <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">
            <li>
                <h3><?= $post->title ?> </h3>
                <p><b>Te feladatod elvégezni</b></p>
            </li>
            <li>
                <h1>Munkaidő: <?= $post->offeredHours ?> óra</h1>
                <p>Mikorra: <?= $post->appointment ?></p>  
                <p>Itt: <?= $post->location ?></p>
                <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
            </li>
            </a>
        </div>
        <?php
    }
}
    
    foreach($allPosts as $post){
    if(!$post->isAccepted){
    
        $owner = $post->getOwner();
        $owner->setAllFromDB();

        ?>

        <div class="box" >
            <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">
            <li>
                <h3><?= $post->title ?> </h3>
                <p>Várakozás alatt</p>
            </li>
            <li>
                <h1>Munkaidő: <?= $post->offeredHours ?> óra</h1>
                <p>Mikorra: <?= $post->appointment ?></p>  
                <p>Itt: <?= $post->location ?></p>
                <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
            </li>
            </a>
        </div>
        <?php
    }
}
    ?>
</ul>
    <?php
}

include 'Footer.php';
?>
