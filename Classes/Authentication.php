<?php
include_once 'Dbh.php';
include_once 'Employer.php';
include_once 'Student.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Login extends Dbh{
    
    public function autherize($email , $password){
        $sqlMatch = $this->connect()->prepare("SELECT id FROM felhasznalok WHERE email = ? AND jelszo = ?;");
        $sqlMatch->execute([$email , $password]);
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
        unset($_SESSION['userId']);
        Header('Location: ../Index.php');
    }
}

class Registration extends Dbh{
    
    public function register($p){
        
        $errors = array();   
        $hasError = FALSE;

        if(!$this->isEmailValid($p['email'])){
            $errors[] = "EmailNotValid";
            $hasError = TRUE;
        }
        if(!$this->isFieldNotExist('felhasznalok', 'email', $p['email'])){
            $errors[] = "EmailAllreadyExists";
            $hasError = TRUE;
        }
        if(!$this->isFieldNotExist('felhasznalok', 'diakigazolvany_szam', $p['studentCard'])){
            $errors[] = "StudentCardAllreadyExists";
            $hasError = TRUE;
        }
        
        if($hasError){
            $errorUrlParams = $this->getErrorUrlParams($errors);
            if($p['userType'] === '0'){
                Header('Location: ../Diak_Registration.php'.$errorUrlParams);
            }
            else if($p['userType'] === '1'){
                Header('Location: ../Munkaado_Registration.php'.$errorUrlParams);
            }
            exit();
        }
    
        $fields = 'vezeteknev, keresztnev, email, email_megerosito, jelszo, felhasznalo_tipus, telefonszam, facebook_id, bemutatkozas, diakigazolvany_szam, oraszam';
        if($p['userType'] === '0'){
            $fields .= ', iskola_id';
        }
        
        $values = '?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?';
        if($p['userType'] === '0'){
            $values .= ', ?';
        }
        
        $bindData = array($p['lastName'], $p['firstName'], $p['email'], $p['emailConfirm'], $p['password'], $p['userType'], $p['phoneNumber'], $p['facebookId'], $p['introduction'], $p['studentCard'], $p['offerHours']);
        if($p['userType'] === '0'){
            array_push($bindData, $p['schoolId']);
        }
        
        $creating = $this->connect()->prepare("INSERT INTO felhasznalok (".$fields.") VALUES (".$values.");");

        print('SchoolId: '.$p['schoolId'].'<br>');
        $creating->execute($bindData);
        
        
        $sqlUserId = $this->connect()->query('SELECT id FROM felhasznalok WHERE email = "'.$p['email'].'";');
        
        $uId = $sqlUserId->fetch();
        
        $_SESSION['userId'] = $uId['id'];
        Header('Location: ../Welcome.php');

    }
    
    private function isEmailValid($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    private function isFieldNotExist($table, $field, $value){
        $match = $this->connect()->query('SELECT id FROM '.$table.' WHERE '.$field.' = "'.$value.'" ;');
        
        if($match->rowCount() > 0){
            return FALSE;
        }
        else{
            return TRUE;
        }       
    }
    
    private function getErrorUrlParams($errors){
        $urlParams = "?err=";
        foreach ($errors as $error){
            $urlParams .=$error.'+';
        }
        $urlParams = rtrim($urlParams , '+');
        return $urlParams;
    }
}