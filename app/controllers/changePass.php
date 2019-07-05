<?php

session_start();

class ChangePass extends Controller {
    public function index() {
        $this->model('User');

        $username = $_SESSION['username'];


        if($_POST) {
            $oldPass = $_POST['passwordOld'];
            $newPass = $_POST['passwordNew'];
            $newPassS = $_POST['passwordNewS'];

            $user = new User($username, $oldPass);

            if ($newPass === $newPassS) {
                
                $user->changePass($oldPass, $newPass);
            }        
        }
        $this->view('profile_view');
    }
}