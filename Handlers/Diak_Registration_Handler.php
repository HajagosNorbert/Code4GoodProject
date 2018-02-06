
<?php
include 'Handlers/Database_Connection.php';

if(!isset($_POST['daiakRegistrationSubmit'])){
    
    echo '<script type="text/javascript"> window.location = "../index.php"</script>';
    
} else{
  
$vezeteknev = $_POST['vezeteknev'];
$keresztnev = $_POST['keresztnev'];
$email = $_POST['email'];
$jelszo = $_POST['jelszo'];
$telefonszam = $_POST['szolgaltato'].$_POST[telefonszam];
$diakigazolvany_szam = $_POST['diakigazolvany_szam'];
$ = $_POST[''];
    
}
?>

