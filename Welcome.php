<?php
include_once 'Header.php';
include_once 'Classes/BrowseJobs.php';
include_once 'Classes/JobPost.php';

if(!isset($user)){
    Header('Location: index.php');
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

<div class="inner row">
<?php
foreach($allPosts as $post){
    if($post->isAccepted){
    
        $owner = $post->getOwner();
        $owner->setAllFromDB();

        ?>
        <div class="4u 6u(medium) 12u$(small)">
            <div class="box" >
                <ul class="alt">
                    <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">
                    <li>
                        <h3><?= $post->title ?> </h3>
                    </li>
                    <li>
                        <p>Munkaidő: <?= $post->offeredHours ?> óra</p>
                        <p>Mikorra: <?= $post->appointment ?></p>  
                        <p>Itt: <?= $post->location ?></p>
                        <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
                        <div style="background-color : #4bae77">
                            <b>Te feladatod</b>
                        </div>
                    </li>
                    </a>
                </ul>
            </div>
        </div>
        <?php
    }
}
    
    foreach($allPosts as $post){
    if(!$post->isAccepted){
    
        $owner = $post->getOwner();
        $owner->setAllFromDB();

        ?>
        <div class="4u 6u(medium) 12u$(small)">
            <div class="box" >
                <ul class="alt">
                    <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;">
                    <li>
                        <h3><?= $post->title ?> </h3>
                    </li>
                    <li>
                        <p>Munkaidő: <?= $post->offeredHours ?> óra</p>
                        <p>Mikorra: <?= $post->appointment ?></p>  
                        <p>Itt: <?= $post->location ?></p>
                        <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
                        <div style="background-color : #ead18c">
                            <b>Várakozás alatt</b>
                        </div>
                    </li>
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

include 'Footer.php';
?>
