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

    public function getConnection(){
        
        return $this->connection;
    }

    public function insertToDB(String $sql, String $types, Array $row)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt -> bind_param($types, ...$row);
        $stmt -> execute();

        $last_id = mysqli_insert_id($this->connection);
        return $last_id;
    }
}
// $dbConnection = DbConnection::getInstance();
// $conn = $dbConnection->getConnection();
