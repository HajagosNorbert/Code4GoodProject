
<?php
include_once '../Classes/Authentication.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST['diakRegistrationSubmit']) && !isset($_POST['munkaadoRegistrationSubmit'])) {
    Header('Location: ../index.php');   
    exit();
}

if(isset($_POST['diakRegistrationSubmit'])){
    $felhasznalo_tipus = '0';
    $registrationPage = "Diak_Registration.php";
}
else if(isset($_POST['munkaadoRegistrationSubmit'])){
    $felhasznalo_tipus = '1';     
    $registrationPage = "Munkaado_Registration.php";

}

$params = array();
$params['lastName'] = $_POST['vezeteknev'];
$params['firstName'] = $_POST['keresztnev'];
$params['email'] = $_POST['email'];
$params['password'] = $_POST['jelszo'];
$params['emailConfirm'] = 'Később megoldani';
$params['facebookId'] = 'Később megoldani';

if($_POST['telefonszam'] !=''){
    $params['phoneNumber'] = $_POST['szolgaltato'].$_POST['telefonszam']; 
}
else{
    $params['phoneNumber'] = 'NULL';
}
if($_POST['bemutatkozas'] != ''){
   $params['introduction'] = $_POST['bemutatkozas']; 
}
else{
    $params['introduction'] = 'NULL';
}
if($felhasznalo_tipus === '0') {
    $params['userType'] = '0';
    $params['studentCard'] = $_POST['diakigazolvany_szam']; 
    $params['schoolId'] = intval($_POST['iskola_id']);
    $params['offerHours'] = "NULL";
 }
 else{
    $params['userType'] = '1';
    $params['studentCard'] = "NULL";
    $params['schoolId'] =  "NULL"; 
    $params['offerHours'] =  5;
 }
    

$regist = new Registration;
$regist->register($params);