<?php 
include_once 'Dbh.php';
class BrowseJobs extends Dbh{
    
    public function getALlPostIds($condition){
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