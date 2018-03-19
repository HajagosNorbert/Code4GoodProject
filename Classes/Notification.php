<?php

class Notification extends Dbh{
    public $id;
    public $notifiedUserId;
    public $title;
    public $content;
    
    public function setId($id){
        $this->id = $id;
    }
    public function setNotifiedUserId($notifiedUserId){
        $this->notifiedUserId = $notifiedUserId;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function setContent($content){
        $this->content = $content;
    }
    
    public function upload(){
        $inserting = $this->connect()->prepare('INSERT INTO ertesitesek (ertesitett_id, cim, tartalom,) VALUES (?, ?, ?)');
        
        $inserting->execute([$this->notifiedUser, $this->title, $this->content]);
    }
    
    public function setAllFromDB(){
        
        $sqlNotification = $this->connect()->prepare("SELECT * FROM ertesitesek WHERE id = ? ;");
        $sqlNotification->execute([$this->id]);
        $notification = $sqlNotification->fetch();
        
        $this->setNotifiedUserId($notification['ertesitett_id']);
        $this->setTitle($notification['cim']);
        $this->setContent($notification['tartalom']);
        
    }
    
    public function deleteFromDB(){
        $deleteNotification = $this->connect()->prepare('DELETE FROM ertesitesek WHERE id = ? ;');
        $deleteNotification->execute([$this->id]);
    }
}