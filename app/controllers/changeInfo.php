<?php

session_start();

class ChangeInfo extends Controller {
    public function index() {
        $this->view('profile_view');
        $this->model('User');

        $username = $_SESSION['username'];

        $msg = "";
        if($_POST) {
            $user = new User($username, '');

            if (!empty($_POST['firstname'])) {
                $firstName = $_POST['firstname'];
                $result = $user->changeFirstName($firstName);
                if ($result['success']) {
                    $msg = 'Successfully changed firstname';
                } else {
                    $msg = $result['error'];
                }
            }
            if (!empty($_POST['lastname'])) {
                $lastName = $_POST['lastname'];
                $result = $user->changeLastName($lastName);
                if ($result['success']) {
                    $msg = $msg . "Successfully changed lastname.";
                } else {
                    $msg = $msg . $result['error'];
                }
            }
            if (!empty($_FILES['img']['name'])) {
                $target = "images/profilePics/";
                $target = $target . basename($_FILES['img']['name']);
                if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                    echo "The file has been uploaded.";

                    $pic = ($_FILES['img']['name']);
                    $result = $user->changeProfilePhoto($pic);
                    if ($result['success']) {
                        $msg = $msg . "Successfully changed profile picture.";
                    } else {
                        $msg = $msg . $result['error'];
                    }
                } else {
                    $msg = $msg . "The file has not been uploaded.";
                }

            }
        }
        echo $msg;
    }
}