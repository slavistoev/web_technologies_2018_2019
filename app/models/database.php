<?php

class Database {
    private $host;
    private $user;
    private $password;
    private $database;

    function connect($filename) {

        if (is_file($filename)) {
            include $filename;
        } else {
            throw new Exception("Error!");
        }

        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            // set the PDO error mode to exception
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
        
    }

    private function closeConnection(&$conn) {
        $conn=null;
    }
}

?>