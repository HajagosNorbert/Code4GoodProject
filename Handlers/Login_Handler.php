<?php
include 'Database_Connection.php';
session_start();


if(!isset($_POST['submit'])){
    Header('Location: ../Index.php');
}
else{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
     mysqli_query($con , "SET NAMES 'utf8';");
    
    $sqlCheckLoginParams = "SELECT * FROM felhasznalok WHERE email = '".$email."' AND jelszo = '".$password."';";
    $sqlResult = mysqli_query($con , $sqlCheckLoginParams);
    

    if(mysqli_num_rows($sqlResult) < 1){
        Header('Location: ../Login.php?loginStatus=failed');
    }
    else
    {
        while($result = mysqli_fetch_assoc($sqlResult)){
            $_SESSION['email'] = $result['email'];
            $_SESSION['firstname'] = $result['keresztnev'];
            $_SESSION['lastname'] = $result['vezeteknev'];
            $_SESSION['userType'] = $result['felhasznalo_tipus'];
            $_SESSION['id'] = $result['id'];
            if($_SESSION['userType'] === '1'){
                $_SESSION['oraszam'] = $result['oraszam'];
            }
        
            Header('Location: ../Welcome.php');
        }
       
    }
}

?>