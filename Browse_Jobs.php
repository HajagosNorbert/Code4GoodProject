<?php 
include_once 'Header.php';
include_once 'Classes/Employer.php';
include_once 'Classes/Student.php';
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

$jobBrowser = new BrowseJobs;
$allPostIds = $jobBrowser->getAllPostIds('WHERE id != (SELECT id FROM ajanlatokra_jelentkezesek WHERE elfogadva = "1")');
$allPosts = array();

foreach ($allPostIds as $postId){
    $jobPost = new JobPost;
    $jobPost->setId($postId)
    $jobPost->setAllFromDB();
    $allPosts[] = $jobPost;
}

foreach($allPosts as $post){
    $owner = $post->getOwner();
    ?>
      <a href="Job.php?id=<?= $post->id ?>" style="text-decoration: none; color: BLACK;"><div style="background-color: #dfdfdf;">
            <h1><?= $post->title ?></h1>
            <h1>Munkaidő: <?= $post->offeredHours ?> óra</h1>
            <p>Mikorra: <?= $post->appointment ?></p>  
            <p>Itt: <?= $post->location ?></p>
            <p>Feltette: <?= $owner->lastName ?> <?= $owner->firstName ?></p>
        </div></a>
        <br><br>
    <?php
}


include 'Footer.php';
?>

