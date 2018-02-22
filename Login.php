<?php
include 'Header.php';
?>
<form action="Handlers/Login_Handler.php" method="POST">
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
        <p>E-mail cím: <input type="text" name="email" placeholder="E-mail *"></p>
        <p>Jelszó: <input type="password" name="password" placeholder="Jelszó *"></p>
        
        <input type="submit" class="gomb2" name="submit" value="Bejelentkezés">
    </form>
<?php include 'Footer.php'?>