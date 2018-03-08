<?php

abstract class Person extends Dbh{
    
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $userType;
    public $phoneNumber;
    public $facebookId;
    public $introduction;
    public $ratingIds = array();
    
    
    public function __construct($_id){
        $sqlPerson = $this->connect()->query("SELECT * FROM felhasznalok WHERE id = '".$_id."';");       
        $sqlRatingIds = $this->connect()->query("SELECT * FROM ertekelesek WHERE ertekelt_id = '".$_id."';");
        
        $person = $sqlPerson->fetch();
            
        $this->id = $person['id'];
        $this->firstName = $person['keresztnev'];
        $this->lastName = $person['vezeteknev'];
        $this->email = $person['email'];
        $this->userType = $person['felhasznalo_tipus'];
        $this->phoneNumber = $person['telefonszam'];
        $this->facebookId = $person['facebook_id'];
        $this->introduction = $person['bemutatkozas'];
        while($_ratingIds = $sqlRatingIds->fetch()){
            $this->ratingIds[] = $_ratingIds['id'];
        }
        return $person;
    }
          
    public function getRatingValues(){
        $ratingValues = array();
        $sqlRatings = $this->connect()->query("SELECT ertekeles FROM ertekelesek WHERE ertekelt_id = '".$this->id."';");  
        
        while($rating = $sqlRatings->fetch()){
            $ratingValues[] = intval($rating['ertekeles']);
        }
        return $ratingValues;
        
        if(count($ratingValues) === 0){
            $average = 0;
        }
        else{
            $average = array_sum($ratingValues) / count($ratingValues);
        }
        return $average;
    }    
    
    public static function createPerson($_id){
        $pdo = new Dbh;
         $sqlUserType = $pdo->connect()->prepare("SELECT felhasznalo_tipus FROM felhasznalok WHERE id = ? ;");
        $sqlUserType->execute([$_id]);
        
        $userType = $sqlUserType->fetch();
        if($userType['felhasznalo_tipus'] === '0'){
            return new Student($_id);
        }
        else if($userType['felhasznalo_tipus'] === '1'){
            return new Employer($_id);
        }
    }

}



