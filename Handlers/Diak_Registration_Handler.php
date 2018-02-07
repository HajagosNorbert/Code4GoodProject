
<?php
include 'Database_Connection.php';

if(!isset($_POST['daiakRegistrationSubmit'])){
    
    Header('Location: ../index.php');
    
} else{
  
    $vezeteknev = mysqli_real_escape_string($con ,$_POST['vezeteknev']);
    $keresztnev = mysqli_real_escape_string($con ,$_POST['keresztnev']);
    $email = mysqli_real_escape_string($con ,$_POST['email']);
    $jelszo = mysqli_real_escape_string($con ,$_POST['jelszo']);
    $diakigazolvany_szam = mysqli_real_escape_string($con ,$_POST['diakigazolvany_szam']);
    $iskola_id = intval($_POST['iskola_id']);
    $felhasznalo_tipus = 1;
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
    
    
    $sqlCreateDiak ="INSERT INTO felhasznalok (vezeteknev, keresztnev, email, jelszo, diakigazolvany_szam, iskola_id, felhasznalo_tipus, facebook_id, telefonszam, bemutatkozas, email_megerosito) VALUES
    (?,?,?,?,?,?,?,?,?,?,?);";
    
    
    
    if(!mysqli_stmt_prepare($stmt, $sqlCreateDiak)){
        echo '<h1>SQL STATEMENT PREPARE HIBA<h1>';
    } 
    else {
        mysqli_stmt_bind_param($stmt ,"sssssiissss" , $vezeteknev, $keresztnev, $email, $jelszo, $diakigazolvany_szam, $iskola_id, $felhasznalo_tipus, $facebook_id, $telefonszam, $bemutatkozas, $email_megerosito);
        
        
        mysqli_stmt_execute($stmt); 
        Header('Location: ../Index.php');
    }
    
   
}
?>

