<?php
include_once 'Header.php';

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

if($visitedUser->userType === '1'){
    $profileType = "munkaadó";
} else if($visitedUser->userType === '0'){
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
<br><br><br><br><br><br>
<h1><?= $visitedUser->lastName ?> <?= $visitedUser->firstName ?></h1>
<h2><?= $profileType ?></h2>
<p>Ide jön az értékelés pl: "4.6 / 5"</p>
<p>Ide jön hányszor értékelték pl: "Dolgozott 6 alkalommal"</p>
<p>Telefonszám: <?= $profilePhone ?></p>
<p> <?= $profileIntroduction ?></p>
<?php
include_once 'Footer.php';