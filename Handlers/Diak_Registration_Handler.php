
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
        echo $telefonszam;
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

    
    mysqli_query($con , "SET NAMES 'utf8';");
    
    $sqlCreateDiak ="INSERT INTO felhasznalok (vezeteknev, keresztnev, email, jelszo, diakigazolvany_szam, iskola_id, felhasznalo_tipus, facebook_id, telefonszam, bemutatkozas, email_megerosito) VALUES ('$vezeteknev', '$keresztnev', '$email', '$jelszo', '$diakigazolvany_szam', '$iskola_id' , '$felhasznalo_tipus' , '$facebook_id' , '$telefonszam' , '$bemutatkozas', '$email_megerosito');";
    
    mysqli_query($con , $sqlCreateDiak);
    
    Header('Location: ../');
}
?>

