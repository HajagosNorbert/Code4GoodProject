<?php 
include 'Header.php';
echo'
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>';

$sqlGetPostedJobs = 'SELECT * FROM ajanlatok WHERE id != (SELECT id FROM ajanlatokra_jelentkezesek WHERE elfogadva = "1");';
$sqlJobs = mysqli_query($con , $sqlGetPostedJobs);

$numberOfJobs = mysqli_num_rows($sqlJobs);




if($numberOfJobs === 0){
    echo'<h1>Nincs ajánlatod</h1>';
}
else{
    while($jobPost = mysqli_fetch_assoc($sqlJobs)){

        $sqlGetMunkaado = "SELECT * FROM felhasznalok WHERE id = '".$jobPost["munkaado_id"]."' ;";
        $sqlMunkaado = mysqli_query($con , $sqlGetMunkaado);
        $munkaado = mysqli_fetch_assoc($sqlMunkaado);
        
        echo'<a href="Job.php?id='.$jobPost["id"].'" style="text-decoration: none; color: BLACK;"><div style="background-color: #dfdfdf;">
                <h1>'.$jobPost["cim"].'</h1>
                <h1>Munkaidő: '.$jobPost["felajanlott_oraszam"].' óra</h1>
                <p>Mikorra: '.$jobPost["munka_idopont"].'</p>  
                <p>Itt: '.$jobPost["helyszin"].'</p>
                <p>Feltette: '.$munkaado["vezeteknev"].' '.$munkaado["keresztnev"].'</p>
            </div></a>
            <br><br>';
    }
    
}

include 'Footer.php';
?>

