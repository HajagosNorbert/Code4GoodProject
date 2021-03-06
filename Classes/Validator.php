<?php

class Validator extends Dbh{
    
    public $errors = array();   
    public $hasError = FALSE;

    public function addError($error){
        $this->errors[] = $error;
        $this->hasError = TRUE;
    }
    
    public function getErrorUrlParams(){
        if(!empty($this->errors)){
            $urlParams = "err=";
            foreach ($this->errors as $error){
                $urlParams .=$error.'+';
            }
            $urlParams = rtrim($urlParams , '+');
            return $urlParams;
        }
            
    }
    
    public function isEmailValid($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    public function containsNumber($text){
        if(1 === preg_match('~[0-9]~', $text)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function containsWhiteSpaces($text){
        return preg_match('/\s/',$text);
              
    }  
    
    public function isFieldNotExists($table, $field, $value){
        $match = $this->connect()->query('SELECT id FROM '.$table.' WHERE '.$field.' = "'.$value.'" ;');
        
        if($match->rowCount() > 0){
            return FALSE;
        }
        else{
            return TRUE;
        }       
    }
}