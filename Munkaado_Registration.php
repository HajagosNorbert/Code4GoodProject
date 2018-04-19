<?php include 'Header.php';

if(isset($_GET['err'])){
    $errors = $_GET['err'];

    if(strpos($errors, "lastNameNotValid") !== FALSE){
        $lastNameNotValid = "Rossz formátum";
    }

    if(strpos($errors, "firstNameNotValid") !== FALSE){
        $firstNameNotValid = "Rossz formátum";
    }
    
    
    if(strpos($errors, "emailNotValid") !== FALSE){
        $emailNotValid = "Rossz formátum";
    }

    
    if(strpos($errors, "emailAllreadyExists") !== FALSE){
        $emailAllreadyExists = "Ezzel a címmel már regisztráltak";
    }

    
    if(strpos($errors, "passwordTooShort") !== FALSE){
        $passwordTooShort = "Legalább 6 karakter";
    }

    
    if(strpos($errors, "phoneNumberNotValid") !== FALSE){
        $phoneNumberNotValid = "Rossz formátum";
    }

    
    if(strpos($errors, "phoneNumberAlreadyExists") !== FALSE){
        $phoneNumberAlreadyExists = "Ezzel a telefonszámmal már regisztráltak";
    }
    
}
?>




<div class="inner">
    <h3>Regisztráció munkaadóként</h3>
    
    <form id="Munkaado_Reg" action="Handlers/Registration_Handler.php" method="POST">
        <div class="row uniform">
            <div class="4u 12u$(small)">
                <?php if(isset($lastNameNotValid)) echo $lastNameNotValid ?>
                <input type="text" name="vezeteknev" placeholder="Vezetéknév">
            </div>
            <div class="4u$ 12u$(small)">
                <?php if(isset($firstNameNotValid)) echo $firstNameNotValid ?>
                <input type="text" name="keresztnev" placeholder="Keresztnév">
            </div>
            <div class="8u$ 12u$(small)">
                <?php if(isset($emailNotValid)) echo $emailNotValid ?>
                <?php if(isset($emailAllreadyExists)) echo $emailAllreadyExists ?>
                <input type="text" name="email" placeholder="E-mail">
            </div>
            <div class="4u$ 12u$(small)">
                <?php if(isset($passwordTooShort)) echo $passwordTooShort ?>
                <input type="password" name="jelszo" placeholder="Jelszó">
            </div>
            <div class="2u 5u(small)">
                <div class="select-wrapper">
                    <select name="szolgaltato">
                        <option value="+3620">+3620</option>
                        <option value="+3630">+3630</option>
                        <option value="+3670">+3670</option>
                    </select>
                </div>
            </div>
            <div class="4u$ 7u$(small)">
                <?php if(isset($phoneNumberNotValid)) echo $phoneNumberNotValid ?>
                <?php if(isset($phoneNumberAlreadyExists)) echo $phoneNumberAlreadyExists ?>
                <input type="text" name="telefonszam" placeholder="Telefonszám">
            </div>
            <div class="8u$ 12u$(small)">
                <textarea name="bemutatkozas" placeholder="Írj magadról. Később megváltoztathatod" id="myTextArea" rows="3"></textarea>
            </div>
            <div class="8u$ 12u$(small)">
                <input type="submit" class="fit" name="munkaadoRegistrationSubmit" value="Regisztrálj">
            </div>
        </div>
    </form>
</div>
<?php include 'Footer.php' ?>
