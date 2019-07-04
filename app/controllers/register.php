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
            $repeat_password = $_POST['password-again'];
            
            $username_regex = '/[\w]{6,25}/i';
            $password_regex = '~(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])^[\w]{6,30}$~';

            if (!preg_match($username_regex, $username)) {
                echo "Username must be between 6 and 25 characters(letters, digits and underscore).";
            }
            else if (!preg_match($password_regex, $password)) {
                echo "Password must be between 6 and 30 characters, containing at least one lower case letter, one upper case letter and one digit";
            }
            else if (strcmp($password, $repeat_password)) {
                echo "Password and repeat password must match";
            }
            else {
                $user = new User($username, $password, $email);
                $user->insertUser();
                header("Location: ./login");
            }
        }

    }

    
}

