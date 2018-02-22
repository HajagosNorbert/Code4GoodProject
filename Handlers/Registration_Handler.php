
<?php
include 'Database_Connection.php';
session_start();

if(!isset($_POST['diakRegistrationSubmit']) && !isset($_POST['munkaadoRegistrationSubmit'])) {
    Header('Location: ../index.php');   
    exit();
}
 else {

    if(isset($_POST['diakRegistrationSubmit'])){
        $felhasznalo_tipus = 0;
        $registrationPage = "Diak_Registration.php";
    }
    else if(isset($_POST['munkaadoRegistrationSubmit'])){
        $felhasznalo_tipus = 1;     
        $registrationPage = "Munkaado_Registration.php";

    }
    
    
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
       
     
     //tualajdonságok megadása felhasználótipus alapján
     if($felhasznalo_tipus === 0) {
        $diakigazolvany_szam = mysqli_real_escape_string($con ,$_POST['diakigazolvany_szam']); 
        $iskola_id = intval($_POST['iskola_id']);
        $oraszam = "NULL";
     }
     else{
        $diakigazolvany_szam = "NULL";
        $iskola_id = "NULL"; 
        $oraszam = 5;
     }
    
    
    $urlParameters = array();   
    $urlCompleteParameters = "";
    
    $stmt = mysqli_stmt_init($con);
     
    mysqli_query($con , "SET NAMES 'utf8';");
     
     
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
    
    if($felhasznalo_tipus === 0) {
        $sqlCreateUser ="INSERT INTO felhasznalok (vezeteknev, keresztnev, email, jelszo, diakigazolvany_szam, iskola_id, felhasznalo_tipus, facebook_id, telefonszam, bemutatkozas, email_megerosito) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
        
        $paramTypes = "sssssiissss";
    }
    else{
        $sqlCreateUser ="INSERT INTO felhasznalok (vezeteknev, keresztnev, email, jelszo, felhasznalo_tipus, facebook_id, telefonszam, bemutatkozas, email_megerosito, oraszam) VALUES (?,?,?,?,?,?,?,?,?,?);";
        $paramTypes = "ssssissssi";

    }
    
    
    if(!mysqli_stmt_prepare($stmt, $sqlCreateUser)){
        echo '<h1>SQL STATEMENT PREPARE ERROR</h1>';
    } 
    else {
         if($felhasznalo_tipus === 0) {
            mysqli_stmt_bind_param($stmt , $paramTypes, $vezeteknev, $keresztnev, $email, $jelszo, $diakigazolvany_szam, $iskola_id, $felhasznalo_tipus, $facebook_id, $telefonszam, $bemutatkozas, $email_megerosito);
         }
        else{
            mysqli_stmt_bind_param($stmt , $paramTypes, $vezeteknev, $keresztnev, $email, $jelszo, $felhasznalo_tipus, $facebook_id, $telefonszam, $bemutatkozas, $email_megerosito, $oraszam);

        }
        $sqlGetId = "SELECT id FROM felhasznalok WHERE email = '".$email."' ;";
        $sqlResult = mysqli_query($con , $sqlGetId);
        $id = mysqli_fetch_assoc($sqlResult);
        
        mysqli_stmt_execute($stmt); 
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $keresztnev;
            $_SESSION['lastname'] = $vezeteknev;
            $_SESSION['userType'] = $felhasznalo_tipus;
            $_SESSION['id'] = $id['id'];
            //ha munaadó
            if($felhasznalo_tipus === '1'){
                $_SESSION['numberOfJobsPosted'] = 0;
                $_SESSION['oraszam'] = $oraszam;
            }
            else if($felhasznalo_tipus === '0'){
                $_SESSION['jobsAplyingFor'] = array();
            }
        
        Header('Location: ../Welcome.php');
    }
       }

    
?>

