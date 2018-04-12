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
print_r($_POST);

$newEmail = $_POST['email'];
$phoneProvider = $_POST['provider'];
$newPhoneNumber = $_POST['phoneNumber'];
$newIntroduction = $_POST['introduction'];
$profileImage = $_FILES['profileImage'];



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

if(!empty($newPhoneNumber)){
    
    $newPhoneNumber = preg_replace('/\s+/', '', $newPhoneNumber);
    
    if(filter_var($newPhoneNumber, FILTER_VALIDATE_INT) && strlen($newPhoneNumber) === 7){
        
        $newPhoneNumber = $phoneProvider.$newPhoneNumber;
        
        if($validator->isFieldNotExists($table, 'telefonszam', $newPhoneNumber)){
            $user->updatePhoneNumberInDB($newPhoneNumber);   
        }
        else{
            $validator->addError('phoneNumberAlreadyExists');
        }
    }
    else{
        $validator->addError('phoneNumberNotValid');
    }
}

if(!empty($newIntroduction)){
    $user->updateIntroductionInDB($newIntroduction);
}


if(file_exists($profileImage['tmp_name']) || is_uploaded_file($profileImage['tmp_name'])){
    
    $fileSize = $profileImage['size'];
    $fileError = $profileImage['error'];
    $fileType = $profileImage['type'];
    
    $fileName = $profileImage['name'];
    $fileTmpName = $profileImage['tmp_name'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowedFormats = array('jpg' , 'jpeg', 'png', 'gif', 'bmp');
    
    if(in_array($fileActualExt, $allowedFormats)){
        if($fileError === 0){
            if($fileSize < 500000){
                
                $fileNameNew = $user->id.".".$fileActualExt;  
                $fileDestination = "../Uploads/Images/profile".$fileNameNew;
                if($user->hasProfileImage){
                    unlink($fileDestination);
                }
                else{
                    $user->updateHasProfileImageInDB('1');
                }
                move_uploaded_file($fileTmpName, $fileDestination);
            
                }
            else{
                $validator->addError('fileTooBig');
            }
        }
        else{
            $validator->addError('fileUploadError');
        }
    }
    else{
        $validator->addError('fileFormatError');
    }
}
$urlErrorParams = $validator->getErrorUrlParams();
$urlUserId = 'id='.$user->id;
Header('Location: ../Profile.php?'.$urlUserId.'&'.$urlErrorParams);