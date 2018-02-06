
<?php
include 'Database_Connection.php';

if(!isset($_POST['daiakRegistrationSubmit'])){
    
    Header('Location: ../index.php');
    
} else{
  
    $vezeteknev = $_POST['vezeteknev'];
    $keresztnev = $_POST['keresztnev'];
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];
    $diakigazolvany_szam = $_POST['diakigazolvany_szam'];
    $iskola_id = intval($_POST['iskola_id']);
    $felhasznalo_tipus = 1;
    $email_megerosito = 'később megoldani';
    
    
    
    if(FALSE){
        //sosem lesz true egyenlőre
        $facebook_id = $_POST['facebook_id'];
    }
    else {
        $facebook_id = "NULL";
    }
    
    if($_POST['telefonszam'] !=''){
        $telefonszam = $_POST['szolgaltato'].$_POST['telefonszam'];
    } 
    else{
        $telefonszam = "NULL";
    }
    
    if($_POST['bemutatkozas'] != ''){
    $bemutatkozas = $_POST['bemutatkozas'];
    }
    else{
        $bemutatkozas = "NULL";
    }
    
    
    $urlParameters = array();
    $urlCompleteParameters = "";
    
    
    mysqli_query($con , "SET NAMES 'utf8';");
    $sqlGetSameEmails ='SELECT * FROM felhasznalok WHERE email ="'.$email.'"';
    $dbEmails = mysqli_query($con , $sqlGetSameEmails);
    $emailAlreadyExists = mysqli_num_rows($dbEmails) > 0;
    
    if($emailAlreadyExists){
        array_push($urlParameters ,'emailAlreadyExists=true');
    }
    
    $sqlGetDiakigazolvany_szamok ='SELECT * FROM felhasznalok WHERE diakigazolvany_szam ="'.$diakigazolvany_szam.'"';
    $dbDiakigazolvany_szamok = mysqli_query($con , $sqlGetDiakigazolvany_szamok);
    $diakigazolvany_szamAlreadyExists = mysqli_num_rows($dbDiakigazolvany_szamok) > 0;
    
    if($diakigazolvany_szamAlreadyExists){
        array_push($urlParameters ,'diakigazolvany_szamAlreadyExists=true');
    }
    
       if($diakigazolvany_szamAlreadyExists || $emailAlreadyExists){
           $urlCompleteParameters .='?';
           foreach($urlParameters as $hiba){
               $urlCompleteParameters .= $hiba.'&';
           }
            $urlCompleteParameters = rtrim($urlCompleteParameters , '&');
           Header('Location: ../Diak_Registration.php'.$urlCompleteParameters);
       }
    
    
    $sqlCreateDiak ="INSERT INTO felhasznalok (vezeteknev, keresztnev, email, jelszo, diakigazolvany_szam, iskola_id, felhasznalo_tipus, facebook_id, telefonszam, bemutatkozas, email_megerosito) VALUES ('$vezeteknev', '$keresztnev', '$email', '$jelszo', '$diakigazolvany_szam', '$iskola_id' , '$felhasznalo_tipus' , '$facebook_id' , '$telefonszam' , '$bemutatkozas', '$email_megerosito');";
    
    mysqli_query($con , $sqlCreateDiak);
    echo $urlCompleteParameters;
    //Header('Location: ../');
}
?>

