<?php

class Database {
    private $host;
    private $user;
    private $password;
    private $database;

    function connect() {     
        $vars = new Vars;
        $this->host = $vars->host;
        $this->user = $vars->user;
        $this->password = $vars->password;
        $this->database = $vars->database;

        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            // set the PDO error mode to exception
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
        
    }

    public function closeConnection(&$conn) {
        $conn=null;
    }
}

?>