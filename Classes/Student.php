<?php
include_once 'Person.php';
class Student extends Person{
    
    public $schoolId;
    public $studentCard;
    
    public function __construct($_id){
        $person = parent::__construct($_id);
        
        $this->studentCard = $person['diakigazolvany_szam'];
        $this->schoolId =$person['iskola_id'];
    }
}