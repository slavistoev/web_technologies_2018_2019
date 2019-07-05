<?php

session_start();

class ChangePass extends Controller {
    public function index() {
        $this->view('profile_view');
        $this->model('User');

        $username = $_SESSION['username'];


        if($_POST) {
            $oldPass = $_POST['passwordOld'];
            $newPass = $_POST['passwordNew'];
            $newPassS = $_POST['passwordNewS'];

            $user = new User($username, $oldPass);
            $password_regex = '~(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])^[\w]{6,30}$~';

            $msg = '';
            if (!preg_match($password_regex, $newPass)) {
                $msg = "Password must be between 6 and 30 characters, containing at least one lower case letter, one upper case letter and one digit";
            } else if (strcmp($newPass, $newPassS)) {
                $msg = "Passwords don't match.";
            } else {
                $result = $user->changePass($newPass);
                if ($result['success']) {
                    $msg = "Password changed successfully";
                } else {
                    $msg = $result['error'];
                }
            }

            echo '<ul class="errors"> ' . $msg . '</ul>';
        }
    }
}