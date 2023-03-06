<?php
class connectju{
    public $sever;
    public $user;
    public $password;
    public $dbName;
    public function __construct()
    {
        $this->sever = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->dbName = "juveshop_quockiet";
    }

    //OPtion1 : mysqli
    function connectToMySQL():mysqli{
        $conn_my = new mysqli($this->sever, $this->user,$this->password, $this->dbName);
        if($conn_my->connect_error){
            die("Failed" .$conn_my->connect_error);
        }else{
    }
    return $conn_my;
    }

    //Option 2
    function connectToPDO():PDO{
        try{
            $conn_pdo = new PDO
            ("mysql:host=$this->sever;dbname=$this->dbName",$this->user, $this->password);
            $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Failed $e");
        }
        return $conn_pdo;

    }
}
$c = new connectju();