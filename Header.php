<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'Classes/Dbh.php';
include_once 'Classes/Person.php';
include_once 'Classes/Employer.php';
include_once 'Classes/Student.php';

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="Content/style.css">
    <title>Webteszt</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <title>Kezdőlap</title>
</head>

<body>
    
   <Header>
    <ul>
        <a href="index.php"><img class="logokep" src="Content/logoteszt.png" title="Code4Good"></a>
        
         <?php
        //belépés és regisztrációs gombok nem bejelentkezetteknek
        if(isset($_SESSION['userId'])){
            $user = Person::createPerson($_SESSION['userId']);
        }
        if(!isset($_SESSION['userId'])){
            ?>
        
            <li><a href="Diak_Registration.php">Regisztráció (Diák)</a></li>
            <li><a href="Munkaado_Registration.php">Regisztráció (Munka adó)</a></li>
            <li><a href="login.php">Bejelentkezés</a></li>
        
        <?php
        }
        //bejelentkezett felhasználónak megjeleniti
         if(isset($user)){            
            echo '<li><a href="Handlers/Logout_Handler.php">Kijelentkezés</a></li>';
             
            if($user->userType === '1'){
                echo '<li><a href="Munkaado_My_Jobs.php">Ajánlataim</a></li>';
            }
            else if($user->userType === '0'){
                echo '<li><a href="Browse_Jobs.php">Munkák</a></li>';
            }
         }
      
        ?>

    </ul>
</Header>
    