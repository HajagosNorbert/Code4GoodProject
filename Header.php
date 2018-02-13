<?php
session_start();
include 'Handlers/Database_Connection.php';

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
        if(!isset($_SESSION['userType'])){
            echo '<li><a href="Diak_Registration.php">Regisztráció (Diák)</a></li>';
            echo '<li><a href="Munkaado_Registration.php">Regisztráció (Munka adó)</a></li>';
            echo '<li><a href="login.php">Bejelentkezés</a></li>';
        }
        //bejelentkezett felhasználónak megjeleniti
         if(isset($_SESSION['userType'])){            
            echo '<li><a href="Handlers/Logout_Handler.php">Kijelentkezés</a></li>';
            if($_SESSION['userType'] === '1'){
                echo '<li><a href="Job_Offering.php">Ajánlj Munkát</a></li>';
            } 
         }
      
        ?>

    </ul>
</Header>
    