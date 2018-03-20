<?php
class Student extends Person{
    
    public $schoolId;
    public $studentCard;
    public $applyingJobIds = array();
    public $acceptedJobIds = array();
    
    public function setSchoolId($schoolId){
        $this->studentCard = $schoolId;
    }
    
    public function setStudentCard($studentCard){
        $this->studentCard = $studentCard;
    }
        
    public function setApplyingJobIdsFromDB(){
        
        $applyings = $this->connect()->prepare('SELECT ajanlat_id, elfogadva FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = ? ;');
        $applyings->execute([$this->id]);
        
        while($applying = $applyings->fetch()){
            if($applying['elfogadva'] === '1'){
                $this->acceptedJobIds[] = $applying['ajanlat_id'];
            }
            $this->applyingJobIds[] = $applying['ajanlat_id'];
        }
    }
    
    public function setAllFromDB(){
        $person = parent::setAllFromDB();
        
        $this->setStudentCard($person['diakigazolvany_szam']);
        $this->setSchoolId($person['iskola_id']);     
    }
    public function __construct(){
        $this->setUserType("0");

    }
    
    public function apply($jobId){
        $applying = $this->connect()->prepare('INSERT INTO ajanlatokra_jelentkezesek (jelentkezo_id, ajanlat_id) VALUES (? , ?);');
        $applying->execute([$this->id, $jobId]);
        
        $this->applyingJobIds[] = $jobId;
    }
    
        public function cancelApplying($jobId){
        $applying = $this->connect()->prepare('DELETE FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = ? AND ajanlat_id = ?;');
        $applying = $applying->execute([$this->id, $jobId]);
        
        unset($this->applyingJobIds[array_search($jobId)]);
        $this->applyingJobIds = array_values($this->applyingJobIds);
    }
    
}