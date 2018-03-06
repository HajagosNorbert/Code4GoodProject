<?php

class Notification extends Dbh{
    public $id;
    public $notifiedUser;
    public $title;
    public $content;
    
    public function create($notifiedUser, $title, $content){
        $this->notifiedUser = $notifiedUser;
        $this->title = $title;
        $this->content = $content;
    }
    
    public function upload(){
        $inserting = $this->connect()->prepare('INSERT INTO ertesitesek (ertesitett_id, cim, tartalom,) VALUES (?, ?, ?)');
        
        $inserting->execute([$this->notifiedUser, $this->title, $this->content]);
    }
    
    public function setAllFromDB($id){
        
        $sqlNotification = $this->connect()->prepare("SELECT * FROM ajanlatok WHERE id =? ;");
        $sqlNotification->execute([$id]);
        $notification = $sqlNotification->fetch();
        
        $this->notifiedUser = $notification['ertesitett_id'];
        $this->title = $notification['cim'];
        $this->content = $notification['tartalom'];
    }
    
    public function deletFromDB($id){
        $deleteNotification = $this->connect()->prepare('DELETE FROM ertesitesek WHERE id = "?" ;');
        $deleteNotifiction->execute([$id]);
    }
}