<?php
class Rating extends Dbh{
    public $id;
    public $ratedUserId;
    public $raterUserId;
    public $value;
    public $comment;
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setRatedUserId($ratedUserId){
        $this->ratedUserId = $ratedUserId;
    }
    
    public function setRaterUserId($raterUserId){
        $this->raterUserId = $raterUserId;
    }
    
    public function setValue($value){
        $this->value = $value;
    }
    
    public function setComment($comment){
        $this->comment = $comment;
    }
    
    public function setAllFromDB(){
        
        $sqlRate = $this->connect()->prepare("SELECT * FROM ertekelesek WHERE id = ?;");  
        $sqlRate->execute([$this->id]);
        $rate = $sqlRate->fetch();
        
        $this->ratedUserId = $rate['ertekelt_id'];
        $this->raterUserId = $rate['ertekelo_id'];
        $this->value = $rate['ertekeles'];
        $this->comment = $rate['megjegyzes'];
    }
    
    public function upload(){
        $sqlRating = $this->connect()->prepare("INSERT INTO ertekelesek (ertekelt_id, ertekelo_id, ertekeles, megjegyzes) VALUES (?, ?, ?, ?);");
        $params = array($this->ratedUserId, $this->raterUserId, $this->value, $this->comment);
        $sqlRating->execute($params);
    }
}    