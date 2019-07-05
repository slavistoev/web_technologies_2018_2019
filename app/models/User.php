<?php

class User {
    private $username;
    private $password;
    private $email;
    private $img;
    private $first_name;
    private $last_name;
    private $db;
    private $pdo;

    public function __construct($username, $password, $email = '', $img = '', $first_name = '', $last_name = '') {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->img = $img;
        $this->first_name = $first_name;
        $this->last_name = $last_name;

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

    public function changePass($newPass) {
        $sql = "SELECT * FROM users WHERE username = '$this->username'";
        $query = $this->pdo->query($sql);

        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user) {
            if(password_verify($this->password, $user['pass'])) {
                $passwordHash = password_hash($newPass, PASSWORD_DEFAULT);
                $this->password = $passwordHash;

                $sql = "UPDATE users SET pass='$passwordHash' WHERE username='$this->username'";
                $query = $this->pdo->query($sql);
                if ($query) {
                    return array("success" => true);
                } else {
                    return array("success" => false, "error" => "Could not change password");
                }
            } else {
                return array("success" => false, "error" => "Wrong old password.");
            }
        } else {
            return array("success" => false, "error" => "Username not found.");
        }

    }

    public function changeFirstName($name) {
        if(preg_match("/^([a-zA-Z\s-]+)$/",$name)) {
            $sql = "UPDATE users SET first_name='$name' WHERE username='$this->username'";
            $query = $this->pdo->query($sql);
            if ($query) {
                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Could not change first name.");
            }
        } else {
            return array("success" => false, "error" => "First name can only have lower and upper case letters, - and space.");
        }
    }
    public function changeLastName($name) {
        if(preg_match("/^([a-zA-Z\s-]+)$/",$name)) {
            $sql = "UPDATE users SET last_name='$name' WHERE username='$this->username'";
            $query = $this->pdo->query($sql);
            if ($query) {
                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Could not change last name.");
            }
        } else {
            return array("success" => false, "error" => "Last name can only have lower and upper case letters, - and space.");
        }           
    }
    
    public function changeProfilePhoto($pic) {
        $sql = "UPDATE users SET img='$pic' WHERE username='$this->username'";
        $query = $this->pdo->query($sql);
        if ($query) {
            return array("success" => true);
        } else {
            return array("success" => false, "error" => "Could not change profile photo.");
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function getImg() {
        return $this->img;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function selectUser() {
        $sql = "SELECT * FROM users WHERE username='$this->username'";
        $query = $this->pdo->query($sql);
        if ($query) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $this->password = $user['pass'];
                $this->email = $user['email'];
                $this->img = $user['img'];
                $this->first_name = $user['first_name'];
                $this->last_name = $user['last_name'];

                return array("success" => true);
            } else {
                return array("success" => false, "error" => "Could not read user.");
            }
        } else {
            return array("success" => false, "error" => "Could not find user.");
        }
    }

    function __destruct() {
        $this->db->closeConnection($this->pdo);
    }
}