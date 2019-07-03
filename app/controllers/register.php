<?php

$dir = dirname(dirname(__FILE__));
include_once $dir . '\models\User.php';

class Register extends Controller {
    public function index() {
        $this->view('register_view');

        if($_POST) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User($username, $password, $email);

            $user->insertUser();
        }

    }

    
}

