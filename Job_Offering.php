<?php include_once 'Header.php';
if(!isset($user)){
    Header('Location: index.php');
    exit();
}


if(isset($_GET['err'])){
    $errors = $_GET['err'];

    if(strpos($errors, "appointmentTooEarly") !== FALSE){
        $appointmentTooEarly = "Legalább 2 órával az időpont előtt kell munkát feltenni";
    }

    if(strpos($errors, "titleNotValid") !== FALSE){
        $titleNotValid = "Nem lehet üres";
    }
    
    
    if(strpos($errors, "locationNotValid") !== FALSE){
        $locationNotValid = "Nem lehet üres";
    }
}

?>

<div class="inner">
<h3>Munka ajánlás:</h3>

<form action="Handlers/Job_Offering_Handler.php" method="POST">
    <div class="row uniform">
            <div class="5u$ 12u$(small)">
                <?php if(isset($titleNotValid)) echo $titleNotValid; ?>
                <input type="text" name="cim" placeholder="Cím">
            </div>
            <div class="5u$ 12u$(small)">
                <?php if(isset($appointmentTooEarly)) echo $appointmentTooEarly.'<br>'; ?>
                Munkakezdés időpontja:
                <input type="datetime-local" name="munkaIdopont" placeholder="Munka kezdete">
            </div>
            <div class="5u$ 12u$(small)">
                <?php if(isset($locationNotValid)) echo $locationNotValid; ?>
                <input type="text" name="helyszin" placeholder="Település, Utca, Házszám/ajtó">
            </div>
            <div class="2u$ 7u$(small)">
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
            <div class="5u$ 12u$(small)">
                <textarea name="leiras" id="myTextArea" rows="6" placeholder="Milyen körülmények között, milyen munka mit kell csinálni stb.."></textarea>
            </div>
            <div class="4u$ 12u$(small)">
                    <input type="submit" class="fit" name="submit" value="Ajánlás">
            </div>
        </div>
    </form>
</div>
<?php include 'Footer.php'; ?>