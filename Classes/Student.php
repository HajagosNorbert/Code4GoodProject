<?php
class Student extends Person{
    
    public $schoolId;
    public $studentCard;
    public $applyingJobIds = array();
    public $acceptedJobIds = array();
    
    public function __construct($_id){
        $person = parent::__construct($_id);
        
        $this->studentCard = $person['diakigazolvany_szam'];
        $this->schoolId =$person['iskola_id'];
        $applyings = $this->connect()->query('SELECT ajanlat_id, elfogadva FROM ajanlatokra_jelentkezesek WHERE jelentkezo_id = "'.$this->id.'" ;');
        
        while($applying = $applyings->fetch()){
            if($applying['elfogadva'] === '1'){
                $this->acceptedJobIds[] = $applying['ajanlat_id'];
            }
            else{
                $this->applyingJobIds[] = $applying['ajanlat_id'];      
            }
        }
        
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