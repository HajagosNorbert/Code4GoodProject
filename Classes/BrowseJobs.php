<?php 

class BrowseJobs extends Dbh{
    
    public function getALlPosts(){
        $allPosts = array();
        
        $sqlAllPosts = $this->connect()->query('SELECT * FROM ajanlatok WHERE id != (SELECT id FROM ajanlatokra_jelentkezesek WHERE elfogadva = "1");');
        
        if($sqlAllPosts->rowCount()){
            while($row = $sqlAllPost->fetch()) {
                $allPosts += $row;
            }
            return $allPosts;
        }
        else{
            return 0;
        }
    }
    
    public function getPostsOwner($post){
        $sqlOwner = $this->connect()->query("SELECT * FROM felhasznalok WHERE id = '".$post["munkaado_id"]."' ;");    
        while($owner = $sqlOwner->fetch()){
            return $owner;
        }
        
    }
    
    public function 
   /* 
   

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
*/
}
