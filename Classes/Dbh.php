<?php 

class Dbh{
    private $dbServername;
    private $dbUsername;
    private $password;
    private $dbName;
    private $charset;
    
    public function connect(){
        $this->dbServername = "sql7.freemysqlhosting.net";
        $this->dbUsername = "sql7233253";
        $this->password = "sNVmvh5A3m";
        $this->dbName = "sql7233253";
        $this->charset = "utf8mb4";
        
//      a freemysqlhosting -hoz a password  7NOhCAikjJjETPwC
        
//        $this->dbServername = "localhost";
//        $this->dbUsername = "root";
//        $this->password = "";
//        $this->dbName = "code4good";
//        $this->charset = "utf8mb4";
        
        
        try{
        $dsn = 'mysql:host='.$this->dbServername.';dbname='.$this->dbName.';charset='.$this->charset;
        $pdo = new PDO($dsn , $this->dbUsername , $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;        
        }
        catch(PDOException $e){
            echo 'Connection failed: '.$e->getMessage();
        }
    }
}