<?php include_once 'Header.php';
if(!isset($user)){
    Header('Location: Index.php');
    exit();
}
?>
<div id="kepes">
</div>
<div class="margo">
</div>
<div class="first">
    Állás hírdetése:
</div>
<br>
<div>
    <form action="Handlers/Job_Offering_Handler.php" method="POST">
        <p>
            Felajánlandó óraszám: <select name="oraszam">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
     </select></p>

        <p>Ajánlat cime<input type="text" name="cim" placeholder="pl.: Favágás,fűnyírás akármi.. xd"></p>
            <p>A munka leírása:
                <p> <textarea name="leiras" id="myTextArea" rows="6" placeholder="Milyen körülmények között, milyen munka mit kell csinálni stb.." cols="80"></textarea></p>

                <!-- Google Maps ez helyett -->
                <p>A munkahely elvégzésére alkalmas pontos cím. <input type="text" name="helyszin" placeholder="Megye, Város, Utca, Házszám/ajtó"></p>

                <p>Munka kezdeti időpontja:
                    <input type="datetime-local" name="munkaIdopont" placeholder="Munka kezdete">
                    <input type="submit" class="gomb2" name="submit" value="Ajánlás"></p>
    </form>
</div>
<?php include 'Footer.php' ?>