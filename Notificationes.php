<?php 
include_once 'Header.php';
include_once 'Classes/Notification.php';
if(!isset($user)){
    Header('Location: index.php');
    exit();
}

if(count($user->notificationIds) === 0){
    ?>
<h3 class="align-center inner"><u><i>Mindennel naprakész vagy!</i></u><h3>
    <?php
}
    else{
?>
    <div class="6u 9u$(small) inner align-center">
<?php
    foreach($user->notificationIds as $notificationId){
        $notification = new Notification;
        $notification->setId($notificationId);
        $notification->setAllFromDB();
        
        $buttonText = "Értettem";
        $content = $notification->content;
        $actionPage = "Handlers/Kill_Notification_Handler.php";
        $actionMethod = "GET";
        $ratedId = "";
        if($notification->title === "Értékeltek!"){
            $buttonText = "Véleményezd milyen volt vele dolgozni";
            $actionPage = "Rate.php";
            $actionMethod = "POST";
            
            $contentAndId = explode('_', $content);
            $content = $contentAndId[0];
            $ratedId = $contentAndId[1];
        }
    ?>
    <div class="inner box">
        <h2><?= $notification->title ?></h2>
        <p><?= $content ?></p>
        <form action="<?= $actionPage ?>" method="<?= $actionMethod ?>">
            <input type="submit" name="submit" value="<?= $buttonText ?>">
            <input type="hidden" name="notificationId" value="<?= $notification->id?>">
            <input type="hidden" name="ratedId" value="<?= $ratedId ?>">
        </form>
    </div>
    <?php
    }
     ?>
    </div>
    <?php
    
}
include_once 'Footer.php';