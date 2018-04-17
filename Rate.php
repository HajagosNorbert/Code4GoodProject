<?php
include_once 'Header.php';
if(!isset($_POST['submit'])){
    Header('Location: Index.php');
    exit();
}

$rated = Person::createPerson($_POST['ratedId']);
$rated->setAllFromDB();
if($rated->userType == 0){
    $rateValueText = "Mennyire vagy megelégedve munkájával 1-től (egyáltalán nem) 5-ig (teljes mértékben) ?";
}
?>


<div class="inner">
    <h3>Értékelés róla: <?= $rated->lastName." ".$rated->firstName ?></h3>
    <form method="POST" action="Handlers/Rate_Handler.php">
        <div class="row uniform">
            <div class="8u$ 10u$(small)">
                <p><?= $rateValueText ?></p>
            </div>
            <div class="1u 12u$(small)">
                <input type="radio" id="rateValue1" name="rateValue" value="1">
                <label for="rateValue1">1</label>
            </div>
            <div class="1u 12u$(small)">
                <input type="radio" id="rateValue2" name="rateValue" value="2">
                <label for="rateValue2">2</label>
            </div>
            <div class="1u 12u$(small)">
                <input type="radio" id="rateValue3" name="rateValue" value="3">
                <label for="rateValue3">3</label>
            </div>
            <div class="1u 12u$(small)">
                <input type="radio" id="rateValue4" name="rateValue" value="4">
                <label for="rateValue4">4</label>
            </div>
            <div class="1u$ 12u$(small)">
                <input type="radio" id="rateValue5" name="rateValue" checked value="5">
                <label for="rateValue5">5</label>
            </div>
            
            <div class="6u$ 10u$(small)">
                <textarea name="comment" placeholder="Mondj véleményt róla: <?= $rated->lastName." ".$rated->firstName ?>" id="myTextArea" rows="3"></textarea>
            </div>
            <div class="3u$">
                <input type="submit" class="fit" name="submit" value="Küldés">
            </div>
            
            <input type="hidden" name="ratedUserId" value="<?= $rated->id ?>">
            <input type="hidden" name="raterUserId" value="<?= $user->id ?>">
            <?php
            if(isset($_POST['jobId'])){
                ?>
                <input type="hidden" name="jobId" value="<?= $_POST['jobId'] ?>">
                <?php
            }
            ?>
        </div>
    </form>  
</div>


<?php
    include_once 'Footer.php';