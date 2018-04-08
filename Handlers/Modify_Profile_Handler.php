<?php

include_once '../Classes/Dbh.php';
include_once '../Classes/Validator.php';
include_once '../Classes/Person.php';
include_once '../Classes/Student.php';
include_once '../Classes/Employer.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    Header('Location: ../Index.php');
    exit();
}

$newEmail = $_POST['email'];
$newPhoneNumber = $_POST['phoneNumber'];
$newIntroduction = $_POST['introduction'];

$user = Person::CreatePerson($_SESSION['userId']);
$user->setAllFromDB();

$validator = new Validator;
$table = 'felhasznalok';
if(!empty($newEmail)){
    
    if($validator->isEmailValid($newEmail)){
        
        if($validator->isFieldNotExists($table, 'email', $newEmail)){
            
            echo'Email átállítva: '.$user->email.' ------>';
            $user->updateEmailInDB($newEmail);
            echo $user->email.'<br>';    
        }
        else{
            $validator->addError('emailAlreadyExists');
        }
    }
    else{
        $validator->addError('emailNotValid');
    }
}

$urlErrorParams = $validator->getErrorUrlParams();
$urlUserId = 'id='.$user->id;
Header('Location: ../Profile.php?'.$urlUserId.'&'.$urlErrorParams);

echo $newEmail.$newPhoneNumber.$newIntroduction;