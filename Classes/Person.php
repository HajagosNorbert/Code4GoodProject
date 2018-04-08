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
    public $ratingValues = array();
    public $ratingIds = array();
    public $notificationIds = array();
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setUserType($userType){
        $this->userType = $userType;
    }
    
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }
    
    public function setFacebookId($facebookId){
        $this->facebookId = $facebookId;
    }
    
    public function setIntroduction($introduction){
        $this->introduction = $introduction;
    }
    
    public function setRatingIdsFromDB(){
        $sqlRatingIds = $this->connect()->prepare("SELECT * FROM ertekelesek WHERE ertekelt_id = ? ;");
        $sqlRatingIds->execute([$this->id]);
        
        while($ratingIds = $sqlRatingIds->fetch()){
            $this->ratingIds[] = $ratingIds['id'];
        }
    }
    
    public function setNotificationIds(){
        $sqlNotificationIds = $this->connect()->prepare("SELECT id FROM ertesitesek WHERE ertesitett_id = ? ;");
        $sqlNotificationIds->execute([$this->id]);
        if($sqlNotificationIds->rowCount() > 0){
            while($notificationId = $sqlNotificationIds->fetch()){
                $this->notificationIds[] = $notificationId['id'];
            }
        }
    }
    
    public function setAllFromDB(){
        $sqlPerson = $this->connect()->prepare("SELECT * FROM felhasznalok WHERE id = ? ;");  
        $sqlPerson->execute([$this->id]);
        $person = $sqlPerson->fetch();
            
        $this->setId($person['id']);
        $this->setFirstName($person['keresztnev']);
        $this->setLastName($person['vezeteknev']);
        $this->setEmail($person['email']);
        $this->setUserType($person['felhasznalo_tipus']);
        if($person['telefonszam'] != "NULL"){
            $this->setPhoneNumber($person['telefonszam']);
        }
        if($person['facebook_id'] != "NULL"){
        $this->setFacebookId($person['facebook_id']);
        }
        if($person['bemutatkozas'] != "NULL"){
        $this->setIntroduction($person['bemutatkozas']);
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
    
    public function updateEmailInDB($email){
        $update = $this->connect()->prepare("UPDATE felhasznalok SET email = ? WHERE id = ?;");
        $update->execute([$email , $this->id]);
        $update->debugDumpParams();
        $this->setEmail($email);
    }
    
    public function updateIntroductionInDB($introduction){
        $update = $this->connect()->prepare("UPDATE felhasznalok SET bemutatkozas = ? WHERE id = ?;");
        $update->execute([$introduction , $this->id]);
    }
    
    public function updatePhoneNumberInDB($phoneNumber){
        $update = $this->connect()->prepare("UPDATE felhasznalok SET telefonszam = ? WHERE id = ?;");
        $update->execute([$phoneNumber , $this->id]);
    }
    
    public static function createPerson($id){
        $pdo = new Dbh;
        $sqlUserType = $pdo->connect()->prepare("SELECT felhasznalo_tipus FROM felhasznalok WHERE id = ? ;");
        $sqlUserType->execute([$id]);
        
        $userType = $sqlUserType->fetch();
        if($userType['felhasznalo_tipus'] === '0'){
            $student = new Student;
            $student->setId($id);
            return $student;
        }
        else if($userType['felhasznalo_tipus'] === '1'){
            $employer = new Employer;
            $employer->setId($id);
            return $employer;
        }
    }
    

}



