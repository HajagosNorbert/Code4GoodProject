<?php 

class Dbh{
    private $dbServername;
    private $dbUsername;
    private $password;
    private $dbName;
    private $charset;
    
    public function connect(){
        $this->dbServername = "localhost";
        $this->dbUsername = "root";
        $this->password = "";
        $this->dbName = "code4good";
        $this->charset = "utf8mb4";
        
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