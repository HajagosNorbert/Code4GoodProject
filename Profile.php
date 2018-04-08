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
if($visitedUser === NULL){
    echo "Nem létezik ilyen felhasználó!";
    exit();
}
$visitedUser->setAllFromDB();
$visitedUser->setRatingIdsFromDB();



$isProfileOfUser = FALSE;

if($visitedUser->id === $user->id){
    $isProfileOfUser = TRUE;
}

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
    $numberOfRatingsText = 'Elvégzett kiadott feladatok: ';
    $profileType = "Munkaadó";
} else if($visitedUser->userType === '0'){
    $numberOfRatingsText = 'Elvégzett munkák száma:';
    $profileType = "Diák";
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
<div class="inner 10u 12u$(small)">
    <h2 class="align-center">
        <strong><?= $visitedUser->lastName ?> <?= $visitedUser->firstName ?></strong> - <?= $profileType ?>
    </h2>
    
    <hr class="major">
    
    <div class="row">
        <?php if ($isProfileOfUser){
        ?>
        <div class="6u 10u$(small)">
            <div class="8u$ 12u$(small)">
                <h3><b>Email címed: </b><?= $visitedUser->email ?></h3>
            </div>
            <?php
            }   
            ?>
            <div class="8u$ 12u$(small)">
                <h4><b>Értékelés: </b><?= $profileRatingAverage ?></h4>
            </div>
            <div class="8u$ 12u$(small)">
                <h4><b><?= $numberOfRatingsText ?></b> <?= count($ratings) ?></h4>
            </div>
            <div class="8u$ 12u$(small)">
                <h4><b>Telefonszám: </b><?= $profilePhone ?></h4>
            </div>
        <?php if ($isProfileOfUser){
        ?>
        </div>
        <?php
        }   

        if ($isProfileOfUser){
            ?>
            <div class="6u 10u$(small)">
                <form method="POST" action="Handlers/Modify_Profile_Handler.php">
                    <div class="row uniform">
                        <div class="8u$ 10u$(small)">
                             <input type="text" name="email" placeholder="Új email cím">
                        </div>

                        <div class="8u$ 10u$(small)">
                            <input type="text" name="phoneNumber" placeholder="Új telefonszám">
                        </div>
                        <div class="10u$ 12u$(small)">
                            <textarea name="introduction" placeholder="Új bemutatkozás" rows="4"></textarea>
                        </div>
                        <div class="10u$ 10u$(small)">
                            <input type="submit" class="fit" name="submit" value="Megváltoztatás">
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }   
            ?>
            <div class="fit">
               <blockquote> <?= $profileIntroduction ?></blockquote>
            </div>
    </div>

</div>
<?php
include_once 'Footer.php';