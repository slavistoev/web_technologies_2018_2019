<?php

class Register extends Controller {
    public function index() {
        $this->view('register_view');
        $this->model('User');

        $error = [];

        if($_POST) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeat_password = $_POST['password-again'];
            
            $username_regex = '/[\w]{6,25}/i';
            $password_regex = '~(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])^[\w]{6,30}$~';
            $email_regex = '/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/';

            $error = '';
            if (!preg_match($username_regex, $username)) {
                $error = "Username must be between 6 and 25 characters(letters, digits and underscore).";
            }
            else if (strcmp($password, $repeat_password)) {
                $error = "Password and repeat password must match";
            }
            else if (!preg_match($password_regex, $password)) {
                $error = "Password must be between 6 and 30 characters, containing at least one lower case letter, one upper case letter and one digit";
            }
            else if (!preg_match($email_regex, $email)) {
                $error = "Email is not valid";
            }
            else {
                $user = new User($username, $password, $email);
                $result = $user->insertUser();
                if ($result['success']) {
                    header("Location: ./login");
                } else {
                    $error = $result['error'];
                }
            }
            echo '<ul class="errors"> ' . $error. '</ul>';
        }

    }

    
}

