<?php

require_once "database.php";

class User extends Database {
    private $userName;
    private $password;
    private $email;

    public function __construct($userName, $password, $email) {
        $this->userName = $userName;
        $this->password = $password;
        $this->db = new Database();
    }
}