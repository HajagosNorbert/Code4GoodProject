
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
//Header('Location: ../Welcome.php');

/*
$vezeteknev = mysqli_real_escape_string($con ,$_POST['vezeteknev']);
$keresztnev = mysqli_real_escape_string($con ,$_POST['keresztnev']);
$email = mysqli_real_escape_string($con ,$_POST['email']);
$jelszo = mysqli_real_escape_string($con ,$_POST['jelszo']);
$email_megerosito = 'később megoldani';
if(FALSE){
    //sosem lesz true egyenlőre
    $facebook_id = mysqli_real_escape_string($con ,$_POST['facebook_id']); 
}
else {
    $facebook_id = "NULL";
}

if($_POST['telefonszam'] !=''){
    $telefonszam =mysqli_real_escape_string($con , $_POST['szolgaltato'].$_POST['telefonszam']);  
}
else{
    $telefonszam = "NULL";
}

if($_POST['bemutatkozas'] != ''){
   $bemutatkozas = mysqli_real_escape_string($con ,$_POST['bemutatkozas']); 
}
else{
    $bemutatkozas = "NULL";
}

*/

 //Ellenőrzés már létező paraméterek lettek megadva, vagy sem

/*
$urlParameters = array();   
$urlCompleteParameters = "";

$stmt = mysqli_stmt_init($con);


$sqlGetSameEmails ='SELECT * FROM felhasznalok WHERE email ="'.$email.'"';
$dbEmails = mysqli_query($con , $sqlGetSameEmails);
$emailAlreadyExists = mysqli_num_rows($dbEmails) > 0;

if($emailAlreadyExists){
    array_push($urlParameters ,'emailAlreadyExists=true');
}

$diakigazolvany_szamAlreadyExists = FALSE;
if($felhasznalo_tipus === 0) {
    $sqlGetDiakigazolvany_szamok ='SELECT * FROM felhasznalok WHERE diakigazolvany_szam ="'.$diakigazolvany_szam.'"';
    $dbDiakigazolvany_szamok = mysqli_query($con , $sqlGetDiakigazolvany_szamok);
    $diakigazolvany_szamAlreadyExists = mysqli_num_rows($dbDiakigazolvany_szamok) > 0;       

}

if($diakigazolvany_szamAlreadyExists){
        array_push($urlParameters ,'diakigazolvany_szamAlreadyExists=true');
    }

if($diakigazolvany_szamAlreadyExists || $emailAlreadyExists){
   $urlCompleteParameters .='?';
   foreach($urlParameters as $hiba){
       $urlCompleteParameters .= $hiba.'&';
   }
   $urlCompleteParameters = rtrim($urlCompleteParameters , '&');
   Header('Location: ../'.$registrationPage.$urlCompleteParameters);
   die();
}
*/

    
?>

