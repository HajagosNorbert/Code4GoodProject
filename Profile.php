<?php
include_once 'Header.php';
include_once 'Classes/Rating.php';

if(!isset($_SESSION['userId'])){
    Header('Location: Index.php');
    exit();
}

if(!isset($_GET['id'])){
    Header('Location: Index.php');
    exit();
}

$profileId=$_GET['id'];

$visitedUser = Person::createPerson($profileId);
$visitedUser->setAllFromDB();
$visitedUser->setRatingIdsFromDB();

$ratings = array();
foreach ($visitedUser->ratingIds as $ratingId){
    $rating = new Rating;
    $rating->setId($ratingId);
    $rating->setAllFromDB();
    $ratings[] = $rating;
}
$ratingSum = 0;
foreach ($ratings as $rating){
    $ratingSum += intval($rating->value);
}
if(count($ratings ) !== 0){
    $ratingAverage = $ratingSum / count($ratings);
    $profileRatingAverage = $ratingAverage.' / 5';
}
else{
    $profileRatingAverage = 'Még nem értékelték';
}

if($visitedUser->userType === '1'){
    $numberOfRatingsText = 'Kiadott munkák száma: ';
    $profileType = "munkaadó";
} else if($visitedUser->userType === '0'){
    $numberOfRatingsText = 'Elvégzett munkák száma';
    $profileType = "diák";
}

if(isset($visitedUser->phoneNumber)){
    $profilePhone = $visitedUser->phoneNumber;
} else{
    $profilePhone = "Nincs beállítva";
}

if(isset($visitedUser->introduction)){
    $profileIntroduction = $visitedUser->introduction;
} else{
    $profileIntroduction = "Még nem állítottam saját bemutatkozást.";
}
?>

<!-- A profile[talujdonság] és a visitedUser->[tulajdonság] ugyan az, de ha valami nincs beállítva a visitedUser -ben, akkor azt másik változóban megváltoztatom valami kitöltő szövegre-->
<div class="inner 6u 12u$(small)">
        <ul class="alt">
        <li class="align-center">
            <h2><strong><?= $visitedUser->lastName ?> <?= $visitedUser->firstName ?></strong>, <?= $profileType ?></h2>
            
        </li>
        <li>
            <p>Értékelés: <?= $profileRatingAverage ?></p>
            <p><?= $numberOfRatingsText ?> <?= count($ratings) ?></p>
            <p>Telefonszám: <?= $profilePhone ?></p>
            <blockquote> <?= $profileIntroduction ?></blockquote>
        </li>
    </ul>
</div>
<?php
include_once 'Footer.php';