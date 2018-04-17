<?php include 'Header.php';
?>




<div class="inner">
    <h3>Diák:</h3>
    
        <form id="Munkaado_Reg" action="Handlers/Registration_Handler.php" method="POST">
            <div class="row uniform">
                <div class="4u 8u$(small)">
                    <input type="text" name="vezeteknev" placeholder="Vezetéknév">
                </div>
                <div class="4u 8u$(small)">
                    <input type="text" name="keresztnev" placeholder="Keresztnév">
                </div>
                <div class="8u$">
                    <input type="text" name="email" placeholder="E-mail">
                </div>
                <div class="3u 6u$(small)">
                    <input type="password" name="jelszo" placeholder="Jelszó">
                </div>
                <div class="3u$ 6u$(small)">
                    <input type="password" name="jelszo_ujra" placeholder="Jelszó újra">
                </div>
                <div class="2u 6u$(small)">
                    <div class="select-wrapper">
                        <select name="szolgaltato">
                            <option value="+3620">+3620</option>
                            <option value="+3630">+3630</option>
                            <option value="+3670">+3670</option>
                        </select>
                    </div>
                </div>
                <div class="4u 6u$(small)">
                    <input type="text" name="telefonszam" placeholder="Telefonszám">
                </div>
                <div class="8u 10u$(small)">
                    <textarea name="bemutatkozas" placeholder="Írj magadról. Később megváltoztathatod" id="myTextArea" rows="3"></textarea>
                </div>
                <div class="8u$">
                    <input type="submit" class="fit" name="munkaadoRegistrationSubmit" value="Regisztrálj">
                </div>
            </div>
        </form>
    </div>
<?php include 'Footer.php' ?>
