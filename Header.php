<?php
session_start();
?>

<head>
    <title>Code4Good Project</title>
</head>


<body>
    <header>
        <form method="get">
            <input type="submit" name="registration-munkaado" value="Regisztrály munkaadóként">
            <input type="submit" name="registration-diak" value="Regisztrály diákként">
        </form>
        <?php
        if(!isset(($_SESSION['isLogedIn'])) || $_SESSION['isLogedIn'] === 0 ){
          echo  '<form method="POST">
        <input type="text" name="email" value="email">
        <br>
        <input type="password" name="password">
        <input type=submit name="login" value="Bejelentkezés">
                </form>';
        }
        ?>
        
        <?php
          if(isset($_GET['registration-munkaado'])){
        echo '<script type="text/javascript"> window.location = "registration-munkaado.php"</script>';        
          } else if(isset($_GET['registration-diak'])){
        echo '<script type="text/javascript"> window.location = "registration-diak.php"</script>';       
          } else {
              
          }
        ?>
    </header>