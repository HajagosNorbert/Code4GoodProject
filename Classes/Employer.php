<?php
include_once 'Person.php';

class Employer extends Person{
    
    public $offerHours;
    public $jobPostIds = array();
    
    public function __construct($_id){
        $person = parent::__construct($_id);
        
        $this->offerHour = $person['oraszam'];
        
        $sqlJobPostIds = $this->connect()->query("SELECT id FROM ajanlatok WHERE munkaado_id = '".$_id."';");  
        while($jobPostId = $sqlJobPostIds->fetch()){
            $this->jobPostIds[] = $jobPostId['id'];
        }

    }
    
    public function postJob()
}