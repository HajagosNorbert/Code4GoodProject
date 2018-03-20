<?php

class Employer extends Person{
    
    public $offerHours;
    public $jobPostIds = array();
    
    public function setOfferHours($offerHours){
        $this->offerHours = $offerHours;
    }
    
    public function setJobPostIdsFromDB(){
        
        $sqlJobPostIds = $this->connect()->prepare("SELECT id FROM ajanlatok WHERE munkaado_id = ?;");  
        $sqlJobPostIds->execute([$this->id]);
        while($jobPostId = $sqlJobPostIds->fetch()){
            $this->jobPostIds[] = $jobPostId['id'];
        }
        
    }
    public function __construct(){
        $this->setUserType("1");
    }
    
    public function setAllFromDB(){
        $person = parent::setAllFromDB();
        
        $this->setOfferHours($person['oraszam']);

    }
}