<?php

require_once "database.php";

class User {
    private $username;
    private $password;
    private $email;
    private $db;
    private $pdo;

    public function __construct($username, $password, $email = '') {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;

        try {
            $this->db = new Database;
            $dir = dirname(dirname(__FILE__));
            $vars = $dir . '\include\vars.php';
            $this->pdo = $this->db->connect($vars);
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertUser() {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT into users (username, email, pass) VALUES ('$this->username' , '$this->email', '$passwordHash')";
        $this->pdo->query($sql);

        $this->db->closeConnection($this->pdo);
    }

    public function loginUser() {
        $sql = "SELECT * FROM users WHERE username = '$this->username'";
        $query = $this->pdo->query($sql);
        $this->db->closeConnection($this->pdo);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user) {
            if(password_verify($this->password, $user['pass'])) {
                $this->password = $user['pass'];
                $this->email = $user['email'];
                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Грешна парола.");
            }
        } else {
            return array("success" => false, "error" => "Грешно потребителско име.");
        }

    }

    public function getUsername() {
        return $this->username;
    }

    public function isValid() {
        
    }
}