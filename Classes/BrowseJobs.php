<?php 

class BrowseJobs extends Dbh{
    
    public function getALlPostIds(){
        $allPostIds = array();
        
        $sqlAllPostIds = $this->connect()->query('SELECT id FROM ajanlatok WHERE id != (SELECT id FROM ajanlatokra_jelentkezesek WHERE elfogadva = "1");');
        
        if($sqlAllPostIds->rowCount()){
            while($row = $sqlAllPostIds->fetch()) {
                array_push($allPostIds , $row['id']);
            }
            return $allPostIds;
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
}