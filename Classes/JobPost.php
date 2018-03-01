<?php
include_once 'Dbh.php';

class JobPost extends Dbh{
    public $id;
    public $ownerId;
    public $offeredHours;
    public $title;
    public $description;
    public $location;
    public $uploadedAt;
    public $appointment;
    public $applicantsId = array();
    public $isAccepted = FALSE;
    public $acceptedStudentId;
    
    public function __construct($_id){
        $sqlPost = $this->connect()->prepare("SELECT * FROM ajanlatok WHERE id =? ;");
        $sqlPost->execute([$_id]);
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
                $this->applicantsId = $applying['jelentkezo_id'];
                if(!$this->isAccepted)
                    $this->isAccepted = $applying['elfogadva'];
                if($applying['elfogadva'] == 1){
                    $acceptedStudentId = $applying['jelentkezo_id'];
                }
            }
            
        }
        
    }
    
    public function getOwner(){       
            return new Employer($this->ownerId);
    }
    
}