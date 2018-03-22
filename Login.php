<?php
include 'Header.php';
?>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
    
<div class="first">
<form action="Handlers/Login_Handler.php" method="POST">

        <p>E-mail cím: <input type="text" name="email" placeholder="E-mail *"></p>
        <p>Jelszó: <input type="password" name="password" placeholder="Jelszó *"></p>
        <br>
        <input type="submit" class="gomb2" name="submit" value="Bejelentkezés">
    </form>
</div>
<?php include 'Footer.php'?>