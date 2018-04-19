
<?php

include_once '../Classes/Dbh.php';
include_once '../Classes/Validator.php';
include_once '../Classes/Authentication.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_POST['diakRegistrationSubmit']) && !isset($_POST['munkaadoRegistrationSubmit'])) {
    Header('Location: ../index.php');   
    exit();
}

if(isset($_POST['diakRegistrationSubmit'])){
    $userType = '0';
    $registrationPage = "Diak_Registration.php";
}
else if(isset($_POST['munkaadoRegistrationSubmit'])){
    $userType = '1';     
    $registrationPage = "Munkaado_Registration.php";

}

$params = array();
$lastName = $_POST['vezeteknev'];
$firstName = $_POST['keresztnev'];
$email = $_POST['email'];
$password = $_POST['jelszo'];
$emailConfirm = 'Később megoldani';
$facebookId = 'Később megoldani';


$phonePersonalNumber = preg_replace('/\s+/', '', $_POST['telefonszam']);
$phoneNumber = $_POST['szolgaltato'].$phonePersonalNumber;

if($_POST['bemutatkozas'] != ''){
   $introduction = $_POST['bemutatkozas']; 
}
else{
    $introduction = 'NULL';
}
if($userType === '0') {
    $studentCard = $_POST['diakigazolvany_szam']; 
    $schoolId = intval($_POST['iskola_id']);
    $offerHours = "NULL";
 }
 else{
    $studentCard = "NULL";
    $schoolId =  "NULL"; 
    $offerHours =  5;
 }
    

$regist = new Registration;

$regist->setLastName($lastName);
$regist->setFirstName($firstName);
$regist->setEmail($email);
$regist->setPassword($password);
$regist->setEmailConfirm($emailConfirm);
$regist->setFacebookId($facebookId);
$regist->setPhoneNumber($phoneNumber);
$regist->setIntroduction($introduction);
$regist->setUserType($userType);
$regist->setStudentCard($studentCard);
$regist->setSchoolId($schoolId);
$regist->setOfferHours($offerHours);


if($regist->containsNumber($regist->lastName) || $regist->containsWhiteSpaces($regist->lastName) || $regist->lastName === ""){
    $regist->addError("lastNameNotValid");
}
   
if($regist->containsNumber($regist->firstName) || $regist->containsWhiteSpaces($regist->lastName) || $regist->lastName === ""){
    $regist->addError("firstNameNotValid");
}

//EMAIL

if(!$regist->isEmailValid($regist->email)){
    $regist->addError("emailNotValid");
}

if(!$regist->isFieldNotExists('felhasznalok', 'email', $regist->email)){
    $regist->addError("emailAllreadyExists");
}

//PASSWORD
if(strlen($regist->password) < 5){
    $regist->addError("passwordTooShort");   
}

if($regist->phoneNumber !== "NULL"){
    if(filter_var($phonePersonalNumber, FILTER_VALIDATE_INT) && strlen($phonePersonalNumber) === 7){

        if(!$regist->isFieldNotExists("felhasznalok", 'telefonszam', $regist->phoneNumber)){
            $regist->addError('phoneNumberAlreadyExists');
        }
    }
    else{
        $regist->addError('phoneNumberNotValid');
    }
    
}
if($regist->studentCard !== "NULL"){
    if(strlen ($regist->studentCard) !== 11 || !filter_var($regist->studentCard, FILTER_VALIDATE_INT)){
        $regist->addError('studentCardNotValid');
    }
    else if(!$regist->isFieldNotExists("felhasznalok", 'diakigazolvany_szam', $regist->studentCard)){
        $regist->addError('studentCardAlreadyExists');
    }
}

if($regist->hasError){
    $errorUrlParams = $regist->getErrorUrlParams();
    if($regist->userType === '0'){
        Header('Location: ../Diak_Registration.php?'.$errorUrlParams);
    }
    else if($regist->userType === '1'){
        Header('Location: ../Munkaado_Registration.php?'.$errorUrlParams);
    }
    exit();
}


$regist->upload();