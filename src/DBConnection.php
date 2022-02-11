<?php
Class DbConnection{
    private static $instance = null;
    private $host = "127.0.0.1", $username = "root", $password = "root", $database = "liebscher_db", $port = 8889;
    private $connection;

    private function __construct() {
        $this->connection = mysqli_connect($this->host,$this->username,$this->password,$this->database,$this->port) or die("Couldn't connect");
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    function getConnection(){
        
        return $this->connection;
    }
}
// $dbConnection = DbConnection::getInstance();
// $conn = $dbConnection->getConnection();
