<?php
include 'Database_Connection.php';
session_start();

if(!isset($_GET['submit'])){
    if($_SESSION["userType"] === '1'){
        Header('Location: ../Munkaado_My_Jobs.php');
        exit();   
    }
    else{
        Header('Location: ../Index.php');
        exit();
    }
}

if(($_GET["hasAcceptedJelentkezo"]) === '1'){
    Header('Location: ../Munkaado_My_Jobs.php');
    exit();
}

$sqlDeleteOffer = 'DELETE FROM ajanlatok WHERE id = "'.$_GET["offerId"].'" ;';
$sqlDeleteOfferJelentkezesek = 'DELETE FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = "'.$_GET["offerId"].'" ;';
$sqlEmptyDeletedOfferJelentkezesek = 'UPDATE ajanlatokra_jelentkezesek SET id = NULL, jelentkezo_id = NULL, ajanlat_id = NULL, elfogadva = NULL WHERE ajanlat_id = "'.$_GET["offerId"].'";';

mysqli_query($con , $sqlEmptyDeletedOfferJelentkezesek);
mysqli_query($con , $sqlDeleteOffer);
mysqli_query($con , $sqlDeleteOfferJelentkezesek);

$sqlMunkaadoOffers = "SELECT * FROM ajanlatok WHERE munkaado_id = '".$_SESSION['id']."' ;";
$resultMunkaadoOffers = mysqli_query($con , $sqlMunkaadoOffers);
$_SESSION['numberOfJobsPosted'] = mysqli_num_rows($resultMunkaadoOffers);

Header('Location: ../Munkaado_My_Jobs.php');
exit();
?>