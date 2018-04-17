<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Login extends Dbh{
    
    private $email;
    private $password;
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function autherize(){
        $sqlMatch = $this->connect()->prepare("SELECT id FROM felhasznalok WHERE email = ? AND jelszo = ?;");
        $sqlMatch->execute([$this->email , $this->password]);
        $match = $sqlMatch->fetch();
        
        if(!$match['id']){
            return FALSE;
        }
        else{  
            $_SESSION['userId'] = $match['id'];
            return TRUE;
        }
    } 
    
    public function logOut(){
        session_unset();
        session_destroy();
        Header('Location: ../index.php');
    }
}


#################################################


class Registration extends Validator{
    
    public $lastName;    
    public $firstName;    
    public $email;    
    public $password;    
    public $emailConfirm;    
    public $facebookId;    
    public $phoneNumber;    
    public $introduction;    
    public $userType;
    
    public $studentCard;
    public $schoolId;
    public $offerHours;


    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setEmailConfirm($emailConfirm){
        $this->emailConfirm = $emailConfirm;
    }
    public function setFacebookId($facebookId){
        $this->facebookId = $facebookId;
    }
    public function setPhoneNumber($phoneNumber){
        $this->lastName = $phoneNumber;
    }
    public function setIntroduction($introduction){
        $this->introduction = $introduction;
    }
    public function setUserType($userType){
        $this->userType = $userType;
    }
    public function setStudentCard($studentCard){
        $this->studentCard = $studentCard;
    }
    public function setSchoolId($schoolId){
        $this->schoolId = $schoolId;
    }
    public function setOfferHours($offerHours){
        $this->offerHours = $offerHours;
    }
    
    public function upload(){
        if($this->userType === '1'){
            $fields = 'vezeteknev, keresztnev, email, email_megerosito, jelszo, felhasznalo_tipus, telefonszam, facebook_id, bemutatkozas, oraszam';
            $values = '?, ?, ?, ?, ?, ?, ?, ?, ?, ?';
            
            $bindData = array($this->lastName, $this->firstName, $this->email, $this->emailConfirm, $this->password, $this->userType, $this->phoneNumber, $this->facebookId, $this->introduction, $this->offerHours);
            
        }
        else if($this->userType === '0'){
            $fields = 'vezeteknev, keresztnev, email, email_megerosito, jelszo, felhasznalo_tipus, telefonszam, facebook_id, bemutatkozas, diakigazolvany_szam, iskola_id';
            $values = '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?';
            $bindData = array($this->lastName, $this->firstName, $this->email, $this->emailConfirm, $this->password, $this->userType, $this->phoneNumber, $this->facebookId, $this->introduction, $this->studentCard, $this->schoolId);
            
        }

        
        $creating = $this->connect()->prepare("INSERT INTO felhasznalok (".$fields.") VALUES (".$values.");");

        $creating->execute($bindData);
        
        $login = new Login;
        $login->setEmail($this->email);
        $login->setPassword($this->password);
        $login->autherize();
        
        Header('Location: ../Welcome.php');
    }
}