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
    public $isAccepted = FALSE;
    public $acceptedStudentId;
    
    public function create($offeredHours, $title, $description, $location, $uploadedAt, $appointment, $ownerId){
        
        $this->ownerId = $ownerId;        
        $this->offeredHours = $offeredHours;        
        $this->title = $title;        
        $this->description = $description;        
        $this->location = $location;        
        $this->uploadedAt = $uploadedAt;        
        $this->appointment = $appointment;        
        $this->ownerId = $ownerId;    
        

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
            $this->id = $post['id'];
            $this->ownerId = $post['munkaado_id'];
            $this->offeredHours = $post['felajanlott_oraszam'];
            $this->title = $post['cim'];
            $this->description = $post['leiras'];
            $this->location = $post['helyszin'];
            $this->uploadedAt = $post['feltoltve'];
            $this->appointment = $post['munka_idopont'];    
            
            $sqlApplyings = $this->connect()->query("SELECT * FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = '".$this->id."' ;");
            while($applying = $sqlApplyings->fetch()){
                $this->applicantIds = $applying['jelentkezo_id'];
                if(!$this->isAccepted)
                    $this->isAccepted = $applying['elfogadva'];
                if($applying['elfogadva'] == 1){
                    $acceptedStudentId = $applying['jelentkezo_id'];
                }
            }
            
        }
        
    }
    
    public function deleteFromDB(){
        
        $title = 'Visszavonva';
        $owner = $this->getOwner();
        $content = 'A '.$this->title.' munkát visszavonta '.$owner->lastName.' '.$owner->firstName.', amire te is jelentkeztél.';
            
        foreach ($this->applicantIds as $applicantId){
            $notification = new Notification;
            $notification->create($applicantId ,$title, $content);
            $notification->upload();
        }
        
        $deletePost = $this->connect()->prepare('DELETE FROM ajanlatok WHERE id = ? ;');
        
        $deletePostApplyings = $this->connect()->prepare('DELETE FROM ajanlatokra_jelentkezesek WHERE ajanlat_id = ? ;');
        $deletePostApplyings->execute([$this->id]);
        $deletePost->execute([$this->id]);
    }
    
    public function setId($_id){
        $this->id = $_id;
    }
    
    public function getOwner(){       
            return new Employer($this->ownerId);
    }
    
    public function getAcceptedStudent(){
        return Person::createPerson($this->acceptedStudentId);
    }
    
}