<?php 
include_once 'Header.php';
include_once 'Classes/BrowseJobs.php';
include_once 'Classes/JobPost.php';



$userNotApplied = "";
if(isset($_SESSION['userId'])){
    $userNotApplied = 'AND jelentkezo_id != "'.$_SESSION['userId'].'"';
}
 $condition = 'WHERE id NOT IN ( SELECT ajanlat_id FROM ajanlatokra_jelentkezesek WHERE ( elfogadva = "1" '.$userNotApplied.') UNION ( SELECT id FROM ajanlatok WHERE( lejart = "1" OR elvegzett = "1" ) ) )';

$jobBrowser = new BrowseJobs;
$allPostIds = $jobBrowser->getAllPostIds($condition);
$allPosts = array();
if ($allPostIds === 0){
    echo '<h2>Nincs ajánlat</h2>';
}
else{
    
foreach ($allPostIds as $postId){
    $jobPost = new JobPost;
    $jobPost->setId($postId);
    $jobPost->setAllFromDB();
    $allPosts[] = $jobPost;
}
?>
<div class="inner 6u 8u$(small) align-center">
    <h3>Munkák</h3>
</div>
<div class="row inner">
<?php
foreach($allPosts as $post){
    $owner = $post->getOwner();
    $owner->setAllFromDB();
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
                    <p>Itt: <?= $post->location ?></p>
                    <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
                </li>
                </a>
            </ul>
        </div>
    </div>  
        <?php
}
    ?>
</div>
    <?php
}

include 'Footer.php';
?>

