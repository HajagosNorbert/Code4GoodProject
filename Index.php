<?php
include 'Header.php';
?>
    
    
    <?php 
    if((!isset($_GET['name']) || ($_GET['name'] == ""))){
        echo "index page";
    } else {
        $_SESSION['name'] = $_GET['name'];
    }
    
        ?>
<h1>Tesztelgetés</h1>


</body>