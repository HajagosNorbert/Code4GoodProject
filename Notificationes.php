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
    <ol class="6u 9u$(small) inner align-center">
<?php
    foreach($user->notificationIds as $notificationId){
        $notification = new Notification;
        $notification->setId($notificationId);
        $notification->setAllFromDB();
        
    ?>
    <li class="inner box">
        <h2><?= $notification->title ?></h2>
        <p><?= $notification->content ?></p>
        <form action="Handlers/Kill_Notification_Handler.php" metho="GET">
            <input type="submit" name="submit" value="Értettem">
            <input type="hidden" name="notificationId" value="<?= $notification->id?>">
        </form>
    </li>
    <?php
    }
     ?>
    </ol>
    <?php
    
}
include_once 'Footer.php';