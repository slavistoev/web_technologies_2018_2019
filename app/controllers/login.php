<?php

session_start();

class Login extends Controller {
    public function index() {
        $this->view('login_view');
        $this->model('User');

        if($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User($username, $password);

            $result = $user->loginUser();
            if($result['success']){
                $_SESSION["username"] = $user->getUsername();
                
                header("Location: ./home_view");
            } else {
                echo '<ul class="errors"> ' . $result['error']. '</ul>';
            }
        }
    }
}