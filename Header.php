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
        <li><a href="kapcsolat">Kapcsolat</a></li>
        <li><a href="Diak_Registration.php">Regisztráció (Diák)</a></li>
        <li><a href="Diak_Registration.php">Regisztráció (Munka adó)</a></li>
        <li><a href="leiras">Állás ajánlatok</a></li>
        <li><a href="Index.php" class="active">Főoldal</a></li>
        
        <?php
         if(!isset(($_SESSION['isLogedIn'])) || $_SESSION['isLogedIn'] === 0 ){
           echo  '<li><a href="login.php">Bejelentkezés</a></li>';
         }
        ?>

    </ul>
</Header>
    