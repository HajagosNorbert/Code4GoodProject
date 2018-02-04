<?php
session_start();
?>
<!doctype html>
<html>

<head>
   
    <link rel="stylesheet" href="Content/style.css">
  <?php if (basename($_SERVER['PHP_SELF']) == 'Munka_Ajanlat_Posztolasa.php')
   echo '<link rel="stylesheet" href="Content/Date_Picker_Style.css">' ?>

    <title>Webteszt</title>
    <meta charset="UTF-8" lang="hu">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
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
    