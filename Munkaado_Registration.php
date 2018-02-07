<?php include 'Header.php';
?>
<div id="kepes">
</div>
<div class="margo">
</div>
<div class="first">
    Regisztrációs felület:
</div>
<div id="elerhetoseg">
    <p>A Csillagal (*) jelölt részek kitöltése kötelező.</p>
    <form action="Handlers/Registration_Handler.php" method="POST">
        <p>Vezetéknév: <input type="text" name="vezeteknev" placeholder="Vezetéknév *"></p>
        <p>Keresztnév: <input type="text" name="keresztnev" placeholder="Keresztnév *"></p>
        <p>E-mail cím: <input type="text" name="email" placeholder="E-mail *"></p>
        <p>Jelszó: <input type="password" name="jelszo" placeholder="Jelszó *"></p>
        <p>Jelszó még egyszer: <input type="password" name="jelszo_ujra" placeholder="Jelszó *"></p>
        <p>Telefonszám
            <select name="szolgaltato">
                <option value="+3620">+3620</option>
                <option value="+3630">+3630</option>
                <option value="+3670">+3670</option>
            </select>
            <input type="text" name="telefonszam" placeholder="Telefonszám *">
        </p>
       <br><br><br>Magadról (Később megváltoztathatod): <br>
        <textarea name="bemutatkozas" placeholder="Írd be ide az üzeneted." id="myTextArea" rows="3" cols="77"></textarea><br><br><br>
        <input type="submit" class="gomb2" name="munkaadoRegistrationSubmit" value="submited">
    </form>
</div>
<div class="copy">
    @copyright  2018-2019
</div>
<?php include 'Footer.php' ?>
