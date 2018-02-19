<?php include 'Header.php';
mysqli_query($con , "SET NAMES 'utf8';");

$sqlGetSchools = "SELECT * FROM iskolak;";
$resultSchools = mysqli_query($con , $sqlGetSchools);

?>

<div id="kepes">
</div>
<div class="margo">
</div>
<div class="first">
    Regisztrációs felület:
</div>
<div id="elerhetoseg"><p>A Csillagal (*) jelölt részek kitöltése kötelező.</p>
    <form action="Handlers/Registration_Handler.php" method="POST">
        <p>Vezetéknév: <input type="text" name="vezeteknev" placeholder="Vezetéknév *"></p>
        <p>Keresztnév: <input type="text" name="keresztnev" placeholder="Keresztnév *"></p>
        <p>E-mail cím: <input type="text" name="email" placeholder="E-mail *"></p>
        <p>Jelszó: <input type="password" name="jelszo" placeholder="Jelszó *"></p>
        <p>Jelszó még egyszer: <input type="password" name="jelszo_ujra" placeholder="Jelszó *"></p>
        <p>Telefonszám <select name="szolgaltato">
  <option value="+3620">+3620</option>
  <option value="+3630">+3630</option>
  <option value="+3670">+3670</option>
     </select>
            <input type="text" name="telefonszam" placeholder
            ="Telefonszám *"></p>
            <p>Diákigazolványszám (11 számjegyű): <input type="text" name="diakigazolvany_szam" maxlength="11" placeholder="diákigazolványszám"></p>
        <p>Iskolák: 
        <select name="iskola_id">
        
           <?php 
             while($rowIskola = mysqli_fetch_assoc($resultSchools)){                
                 echo '<option value="'.$rowIskola["id"].'" >'.$rowIskola["nev"].'</option>';
             }           
            ?>
  
  
        </select></p>
        
        <br><br><br>Magadról (Később megváltoztathatod): <br>
        <textarea name="bemutatkozas" placeholder="Írd be ide az üzeneted." id="myTextArea" rows="3" cols="77"></textarea><br><br><br>
        <input type="submit" class="gomb2" name="diakRegistrationSubmit" value="Regisztálj">
    </form>
</div>
<div class="copy">
    @copyright Kanyári Krisztofer. 2018-2019
</div>
<?php include 'Footer.php' ?>
