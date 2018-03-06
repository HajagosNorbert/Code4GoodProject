<?php
class Rating extends Dbh{
    public $id;
    public $ratedPerson;
    public $raterPerson;
    public $value;
    public $comment;
    
    
    public function __construct($_id){
        
        $sqlRate = $this->connect()->query("SELECT * FROM ertekelesek WHERE id = '".$_id."';");  
        
        $this->id = $_id;
        $this->ratedPerson = $sqlRate['ertekelt_id'];
        $this->raterPerson = $sqlRate['ertekelo_id'];
        $this->$value = $sqlRate['ertekeles'];
        $this->$comment = $sqlRate['megjegyzes'];
        
    }
}    
?>