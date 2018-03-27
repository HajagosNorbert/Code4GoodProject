<?php
class JobPost extends Dbh{
    public $id;
    public $ownerId;
    public $offeredHours;
    public $title;
    public $description;
    public $location;
    public $uploadedAt;
    public $appointment;
    public $applicantIds = array();
    public $isAccepted;
    public $acceptedStudentId;
    
    public function __construct(){
        $this->isAccepted = FALSE;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
    }
    
    public function setOfferedHours($offeredHours){
        $this->offeredHours = $offeredHours;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function setLocation($location){
        $this->location = $location;
    }
    
    public function setUploadedAt($uploadedAt){
        $this->uploadedAt = $uploadedAt;
    }
    
    public function setAppointment($appointment){
        $this->appointment = $appointment;
    }  
    
    public function setIsAccepted($isAccepted){
        $this->isAccepted = $isAccepted;
    }
    
    public function setApplicantIdsFromDB(){
        $sqlApplyings = $this->connect()->query("SELECT * FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = '".$this->id."' ;");
        while($applying = $sqlApplyings->fetch()){
            $this->applicantIds[] = $applying['jelentkezo_id'];
            if(!$this->isAccepted && $applying['elfogadva'] == 1){
                $this->setIsAccepted(TRUE);
                $this->setAcceptedStudentId($applying['jelentkezo_id']);
            }
        }    
    }
    
    public function setAcceptedStudentId($studentId){
        $this->acceptedStudentId = $studentId;
        $this->isAccepted = TRUE;
    }
    
    public function create($offeredHours, $title, $description, $location, $uploadedAt, $appointment, $ownerId){
        
        $this->setOwnerId($ownerId);        
        $this->setOfferedHours($offeredHours);        
        $this->setTitle($title);        
        $this->setDescription($description);        
        $this->setLocation($location);        
        $this->setUploadedAt($uploadedAt);        
        $this->setAppointment($appointment);        
        $this->setOwnerId($ownerId);     
    }
//    GETTERS
    public function getOwner(){  
        $owner = new Employer();
        $owner->setId($this->ownerId);
        return $owner;
    }
    
    public function getAcceptedStudent(){
        $student = new Student;
        $student->setId($this->acceptedStudentId);
        return $student;
    }
    
    public function upload(){
        $newPost = $this->connect()->prepare(" INSERT INTO ajanlatok (munkaado_id, felajanlott_oraszam, cim, leiras, helyszin, feltoltve, munka_idopont) VALUES (?,?,?,?,?,?,?);");
        
        try{
        $newPost->execute([$this->ownerId, $this->offeredHours, $this->title, $this->description, $this->location, $this->uploadedAt, $this->appointment]);
        return TRUE;
        }
        catch(PDOException $e){
            return FALSE;
        }
    }
    
    public function setAllFromDB(){
        $sqlPost = $this->connect()->prepare("SELECT * FROM ajanlatok WHERE id =? ;");
        $sqlPost->execute([$this->id]);
        if($post = $sqlPost->fetch()){
            $this->setOwnerId($post['munkaado_id']);
            $this->setOfferedHours($post['felajanlott_oraszam']);
            $this->setTitle($post['cim']);
            $this->setDescription($post['leiras']);
            $this->setLocation($post['helyszin']);
            $this->setUploadedAt($post['feltoltve']);
            $this->setAppointment($post['munka_idopont']);    
        }
    }
    
    public function deleteFromDB(){
        
        $deletePost = $this->connect()->prepare('DELETE FROM ajanlatok WHERE id = ? ;');
        
        $deletePostApplyings = $this->connect()->prepare('DELETE FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = ? ;');
        $deletePostApplyings->execute([$this->id]);
        $deletePost->execute([$this->id]);
    }
    
    public function uploadAcceptedApplying(){
        if($this->isAccepted === TRUE){
            $elfogadva = '1';
            
            $applying = $this->connect()->prepare('UPDATE ajanlatokra_jelentkezesek SET elfogadva = ? WHERE jelentkezo_id = ? AND ajanlat_id = ? ;');    
            
            $applying->execute([$elfogadva, $this->acceptedStudentId, $this->id]);
        }
        else{
            $elfogadva = '0';
            
            $applying = $this->connect()->prepare('UPDATE ajanlatokra_jelentkezesek SET elfogadva = ? WHERE ajanlat_id = ? ;');    
            
            $applying->execute([$elfogadva, $this->id]);
        }
    }
}