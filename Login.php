<?php
include_once 'Header.php';
?>
<div class="inner">

    <h2>Bejelentkezés</h2>

    <form action="Handlers/Login_Handler.php" method="POST">
        <div class="row uniform">
            <div class="5u 12u$(small)">
                <input type="text" name="email" placeholder="E-mail">
            </div>
            <div class="5u 12u$(small)">
                <input type="password" name="password" placeholder="Jelszó">
            </div>
            <div class="10u$ 12u$(small)">
                <input type="submit" name="submit" value="Bejelentkezés">
            </div>
        </div>
    </form>
</div>
<?php 
include_once 'Footer.php';
?>