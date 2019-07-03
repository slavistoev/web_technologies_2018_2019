<?php

//require_once '../models/database.php';

class Register extends Controller {
    public function index() {
        $this->view('register_view');

        //session_start();

        //header('Content-type: application/json');

        try {
            $dir = dirname(dirname(__FILE__));
            include_once $dir . '\models\database.php';
            $vars = $dir . '\include\vars.php';

            $db = new Database;
            $pdo = $db->connect($vars);
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }

        if($_POST) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT into users (username, email, pass) VALUES ('$username' , '$email', '$password')";
            $pdo->query($sql);

            $db->closeConnection($pdo);
        }
    }

    
}

