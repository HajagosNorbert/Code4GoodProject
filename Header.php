<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'Classes/Dbh.php';
include_once 'Classes/Person.php';
include_once 'Classes/Employer.php';
include_once 'Classes/Student.php';


$bodyClass = "subpage";
$homePage = 'Welcome.php';
if(isset($pageName)){
    if($pageName === 'Index.php'){
        $bodyClass = "";
        $homePage ="Index.php";
    }
}


if(isset($_SESSION['userId'])){
    $user = Person::createPerson($_SESSION['userId']);
    $user->setAllFromDB(); 
    $user->setNotificationIds();
    $numberOfNotificationes = count($user->notificationIds);
}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Easy 50 hours</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="<?= $bodyClass; ?>" >

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="<?= $homePage ?>" class="logo"><strong>Easy 50 hours</strong> by Skipped Question</a>
                    <!-- Navigációs felület-->
                        <nav id="nav">
                            <?php
                                if(!isset($user)){
                            ?>
                            
                            <!-- Nem bejelentkezett felhasználóknak-->
                                <a href="Login.php">Bejelnetkezés</a>
                                <a href="Diak_Registration.php">Diák vagyok</a>
                                <a href="Munkaado_Registration.php">Munkaadó vagyok</a>
                            
                            <?php
                                }
                                if(isset($user)){
                            ?>
                            <!-- Bejelentkezett felhasználóknak -->
                                <a href="Notificationes.php">Értesítések: <?= $numberOfNotificationes?></a>
                                <a href="Profile.php?id=<?= $user->id ?>"><?= $user->lastName ?> <?= $user->firstName ?></a>

                                <?php
                                        if($user->userType === '1'){
                                ?>

                                <a href="Munkaado_My_Jobs.php">Ajánlataim</a>

                                <?php
                                        }
                                        else if($user->userType === '0'){
                                ?>
                                <a href="Browse_Jobs.php">Munkák</a>
                                <?php
                                        }
                                ?>
                                <a href="Handlers/Logout_Handler.php">Kijelentkezés</a>
                                <?php
                                    }
                                ?>
                        </nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>