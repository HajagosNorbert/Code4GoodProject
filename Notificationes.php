<?php 
include_once 'Header.php';
include_once 'Classes/Notification.php';
echo '<br><br><br><br><br><br><br><br><br><br>';

if(count($user->notificationIds) === 0){
    ?>
        <h1>Mindennel naprakész vagy!<h1>
    <?php
}
    else{

    foreach($user->notificationIds as $notificationId){
        $notification = new Notification;
        $notification->setId($notificationId);
        $notification->setAllFromDB();
        
    ?>
<div class="first">
    <h2><?= $notification->title ?></h2>
    <p><?= $notification->content ?></p>
    <form action="Handlers/Kill_Notification_Handler.php" metho="GET">
        <input type="submit" name="submit" value="Értettem">
        <input type="hidden" name="notificationId" value="<?= $notification->id?>">
    </form>
    <br>
</div>
    <?php
    }
    
}
include_once 'Footer.php';