<?php

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
            $this->pdo = $this->db->connect();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertUser() {
        $sql = "SELECT * FROM users WHERE username = '$this->username' OR email = '$this->email'";
        $query = $this->pdo->query($sql);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return array("success" => false, "error" => "User name or email is taken.");
        }
        
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT into users (username, email, pass) VALUES ('$this->username' , '$this->email', '$passwordHash')";
        $this->pdo->query($sql);

        return array("success" => true);
    }

    public function loginUser() {
        $sql = "SELECT * FROM users WHERE username = '$this->username'";
        $query = $this->pdo->query($sql);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user) {
            if(password_verify($this->password, $user['pass'])) {
                $this->password = $user['pass'];
                $this->email = $user['email'];
                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Wrong password.");
            }
        } else {
            return array("success" => false, "error" => "Wrong user name.");
        }

    }

    public function changePass($oldPass, $newPass) {
        $sql = "SELECT * FROM users WHERE username = '$this->username'";
        $query = $this->pdo->query($sql);

        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user) {
            if(password_verify($this->password, $user['pass'])) {
                
                $this->password = $newPass;
                $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET pass='$passwordHash' WHERE username='$this->username'";
                $result = $this->pdo->query($sql);
                
            } else {
                return array("success" => false, "error" => "Wrong old password.");
            }
        } else {
            return array("success" => false, "error" => "Username not found.");
        }

    }

    public function changeFirstName($name) {
        if(preg_match("/^([a-zA-Z' ]+)$/",$name)) {
            $sql = "UPDATE users SET first_name='$name' WHERE username='$this->username'";
            $result = $this->pdo->query($sql);
        }
    }
    public function changeLastName($name) {
        if(preg_match("/^([a-zA-Z' ]+)$/",$name)) {
            $sql = "UPDATE users SET last_name='$name' WHERE username='$this->username'";
            $result = $this->pdo->query($sql);
        }               

    }
    
    public function changeProfilePhoto($pic) {
        $sql = "UPDATE users SET img='$pic' WHERE username='$this->username'";
        $result = $this->pdo->query($sql);
    }

    public function getUsername() {
        return $this->username;
    }

    function __destruct() {
        $this->db->closeConnection($this->pdo);
    }
}