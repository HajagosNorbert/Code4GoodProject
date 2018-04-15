<?php include_once 'Header.php';
if(!isset($user)){
    Header('Location: Index.php');
    exit();
}
?>

<div class="inner">
<h3>Munka ajánlás:</h3>

<form action="Handlers/Job_Offering_Handler.php" method="POST">
    <div class="row uniform">
            <div class="5u$ 8u$(small)">
                <input type="text" name="cim" placeholder="Cím">
            </div>
            <div class="5u$ 8u$(small)">
                Munkakezdés időpontja:
                <input type="datetime-local" name="munkaIdopont" placeholder="Munka kezdete">
            </div>
            <div class="5u$">
                <input type="text" name="helyszin" placeholder="Település, Utca, Házszám/ajtó">
            </div>
            <div class="2u$ 6u$(small)">
                Felajánlott órák száma:
                <div class="select-wrapper">
                          <select name="oraszam">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                     </select>
                </div>
            </div>
            <div class="5u$ 8u$(small)">
                <textarea name="leiras" id="myTextArea" rows="6" placeholder="Milyen körülmények között, milyen munka mit kell csinálni stb.."></textarea>
            </div>
            <div class="8u$">
                    <input type="submit" class="fit" name="submit" value="Ajánlás">
            </div>
        </div>
    </form>
</div>
<?php include 'Footer.php' ?>