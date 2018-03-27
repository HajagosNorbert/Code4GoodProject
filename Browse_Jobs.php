<?php 
include_once 'Header.php';
include_once 'Classes/BrowseJobs.php';
include_once 'Classes/JobPost.php';


echo'
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>';


$userNotApplied = "";
if(isset($_SESSION['userId'])){
    $userNotApplied = 'AND jelentkezo_id != "'.$_SESSION['userId'].'"';
}
$condition = 'WHERE id NOT IN (SELECT ajanlat_id FROM ajanlatokra_jelentkezesek WHERE (elfogadva = "1" '.$userNotApplied.' ))';

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

foreach($allPosts as $post){
    $owner = $post->getOwner();
    $owner->setAllFromDB();
    ?>
    <div class="first">
      <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;"><div style="background-color: #dfdfdf;">
            <h1><?= $post->title ?></h1>
            <h1>Munkaidő: <?= $post->offeredHours ?> óra</h1>
            <p>Mikorra: <?= $post->appointment ?></p>  
            <p>Itt: <?= $post->location ?></p>
          <p>Feltette: <a href="Profile.php?id=<?= $owner->id?>"><?= $owner->lastName ?> <?= $owner->firstName ?></a></p>
        </div></a>
    </div>
        <br><br>
    <?php
}
}

include 'Footer.php';
?>

