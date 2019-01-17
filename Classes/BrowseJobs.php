<?php 
class BrowseJobs extends Dbh{
    
    public function getAllPostIds($condition){
        $allPostIds = array();
        
        $sqlAllPostIds = $this->connect()->query('SELECT id FROM ajanlatok '.$condition.';');
        
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
}