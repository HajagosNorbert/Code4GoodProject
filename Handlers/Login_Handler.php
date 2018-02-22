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
            //ha munaadó
            if($_SESSION['userType'] === '1'){
                
                $sqlMunkaadoOffers = "SELECT * FROM ajanlatok WHERE munkaado_id = '".$_SESSION['id']."' ;";
                $resultMunkaadoOffers = mysqli_query($con , $sqlMunkaadoOffers);
                
                $_SESSION['numberOfJobsPosted'] = mysqli_num_rows($resultMunkaadoOffers);
                $_SESSION['oraszam'] = $result['oraszam'];
            }
            else if($_SESSION['userType'] === '0'){
                $_SESSION['jobsAplyingFor'] = array();
                    
                $sqlGetJobsAplyingFor = 'SELECT ajanlat_id FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = "'.$_SESSION['id'].'";';
                $sqlJobsAplyingFor = mysqli_query($con, $sqlGetJobsAplyingFor);
                if(mysqli_num_rows($sqlJobsAplyingFor) > 0){
                    while($jobApyingFor = mysqli_fetch_assoc($sqlJobsAplyingFor)){
                        array_push($_SESSION['jobsAplyingFor'] , $jobApyingFor['id']);
                    }
                }
                
                
            }
        
            Header('Location: ../Welcome.php');
        }
       
    }
}

?>