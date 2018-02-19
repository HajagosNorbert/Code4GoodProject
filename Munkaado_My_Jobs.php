<?php 
include 'Header.php';

if($_SESSION['userType'] != 1){
    Header('Location: Index.php');
    exit();
}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
$sqlGetPostedJobs = 'SELECT * FROM ajanlatok WHERE munkaado_id = "'.$_SESSION["id"].'";';
$sqlResult = mysqli_query($con , $sqlGetPostedJobs);

$numberOfJobs = mysqli_num_rows($sqlResult);

if($numberOfJobs === 0){
    echo'<h1>Nincs ajánlatod</h1>';
}
else{
    while($JobPost = mysqli_fetch_assoc($sqlResult)){
        
        $sqlGetJelentkezok = 'SELECT * FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = "'.$JobPost["id"].'";';
        $jelentkezok = mysqli_query($con , $sqlGetJelentkezok);
        $numberOfJelentkezok = mysqli_num_rows($jelentkezok);
        
        $sqlGetAcceptedJelentkezes = 'SELECT * FROM ajanlatokra_jelentkezesek WHERE elfogadva = "1" AND ajanlat_id = "'.$JobPost["id"].'" ;';
        $acceptedJelentkezes = mysqli_query($con , $sqlGetAcceptedJelentkezes);
        $numberOfAcceptedJelentkezes = mysqli_num_rows($acceptedJelentkezes);
                
        if($numberOfAcceptedJelentkezes === 0)
            $hasAcceptedJelentkezo = FALSE;
        else{
            
            $hasAcceptedJelentkezo = TRUE;
        
            $sqlGetAcceptedJelentkezo = NULL;
            $resultAcceptedJelentkezok = mysqli_fetch_assoc($acceptedJelentkezes);
            $sqlGetAcceptedJelentkezo = 'SELECT * FROM felhasznalok WHERE id ="'.$resultAcceptedJelentkezok["jelentkezo_id"].'" ;';
            $acceptedJelentkezo = mysqli_query($con , $sqlGetAcceptedJelentkezo);
            $resultAcceptedJelentkezo = mysqli_fetch_assoc($acceptedJelentkezo);
        }
       
              
        
        
       echo'<div class="job-post">
            <div>
                <h1>
                    '.$JobPost["cim"].'
                </h1>
            </div>
    
            <div class="hours-offered">
                <h1>
                    Munkaidő: '.$JobPost["felajanlott_oraszam"].' óra
                </h1>
            </div>
            <div class="upload-date">
                <p>
                    Feltéve: '.$JobPost["feltoltve"].'   
                </p>  
            </div>
            <div>
                <p>Mikorra: '.$JobPost["munka_idopont"].'</p>
            
            </div>
                <div>
                    <p>';
                    if($numberOfJelentkezok === 0)
                        echo'Nincs jelenkező';
                    else if($hasAcceptedJelentkezo)
                        echo 'Elfogadta: '.$resultAcceptedJelentkezo['vezeteknev'].' '.$resultAcceptedJelentkezo['keresztnev'];
                    else
                        echo 'Jelentkezők: '.$numberOfJelentkezok;
                echo'</p>              
                </div>
                <form method="GET" action="Handlers/Job_Offer_Delete_Handler.php">
                    <input type="submit" name="submit" value="Visszavonása">
                    <input type="hidden" name=offerId value="'.$JobPost["id"].'">
                    <input type="hidden" name=hasAcceptedJelentkezo value="'.$hasAcceptedJelentkezo.'">
                </form>
            </div>
            <br>';
    }
    
}

echo '<h1 ><a href="';
if($_SESSION["numberOfJobsPosted"] <3)
    echo'Job_Offering.php';
else
    echo ''.basename($_SERVER['PHP_SELF']).'?problem=tooMuchPosts';
echo '">Ajánlj Munkát ('.$_SESSION["numberOfJobsPosted"].'/3)</a></h1>';

?>


<?php 
include 'Footer.php';
?>