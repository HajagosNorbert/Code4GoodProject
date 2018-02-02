<?php include 'Header.php';?>
<div id="kepes">
</div>
<div class="margo">
</div>
<div class="first">
    Regisztrációs felület:
</div>
<div id="elerhetoseg"> A Csillagal (*) jelölt részek kitöltése kötelező.
    <br>
    <form action="Handlers/Diak_Registration_Handler.php" method="POST">
        <p>Vezetéknév: <input type="text" name="Felhasználó név" value="Vezetéknév *"></p>
        <p>Keresztnév: <input type="text" name="Felhasználó név" value="Keresztnév *"></p>
        <p>E-mail cím: <input type="text" name="E-Mail" value="E-mail *"></p>
        <p>Jelszó: <input type="text" name="E-Mail" value="Jelszó *"></p>
        <p>Jelszó még egyszer: <input type="text" name="E-Mail" value="Jelszó *"></p>
        <p>Telefonszám <select>
  <option value="telo2">+3620</option>
  <option value="telo">+3630</option>
  <option value="telo3">+3670</option>
     </select>
            <input type="text" name="E-Mail" value="Telefonszám *"></p>
            <p>Diákigazolványszám (11 számjegyű): <input type="text" name="diákszám" maxlength="11" placeholder="diákigazolványszám"></p>
        <p>Iskolák: <select>
  <option value="gd">Gábor Dénes</option>
  <option value="hs">Hansági</option>
  <option value="mr">MÓRA</option>
  <option value="dk">Deák</option>
</select></p>
        <br><br><br>Magadról (Később megváltoztathatod): <br>
        <textarea name="bemutatkozas" id="myTextArea" rows="3" cols="77">Írd be ide az üzeneted.</textarea><br><br><br>
        <input type="submit" class="gomb2" name="daiakRegistrationSubmit" value="Elküldés">
    </form>
</div>
<div class="copy">
    @copyright Kanyári Krisztofer. 2018-2019
</div>
<?php include 'Footer.php' ?>
