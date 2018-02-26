<?php

class JobPost extendes Dbh{
    $id;
    $ownerId;
    $offeredHours;
    $title;
    $description;
    $location;
    $uploadedAt;
    $appointment;
    $applicantsId = array();
    $isAccepted = FALSE;
    $acceptedStudentId;
    
    public __construct($_id){
        $sqlPost = $this->connect()->query("SELECT * WHERE id = '".$_id."';");
        
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
                $this->applicantsId += $applying['jelentkezo_id'];
                if(!isAccepted)
                    $this->isAccepted = $applying['elfogadva'];
                if($applying['elfogadva'] == 1){
                    $acceptedStudentId = $applying['jelentkezo_id'];
                }
            }
            
        }
        
    }
}