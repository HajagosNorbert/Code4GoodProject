<?php

class Validator extends Dbh{
    
    public $errors = array();   
    public $hasError = FALSE;

    public function addError($error){
        $this->errors[] = $error;
        $this->hasError = TRUE;
    }
    
    public function isEmailValid($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }
        else{
            return TRUE;
        }
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
    
    public function getErrorUrlParams(){
        $urlParams = "err=";
        foreach ($this->errors as $error){
            $urlParams .=$error.'+';
        }
        $urlParams = rtrim($urlParams , '+');
        return $urlParams;
    }
}