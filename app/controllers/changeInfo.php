<?php

session_start();

class ChangeInfo extends Controller {
    public function index() {
        $this->model('User');

        try {
            $db = new Database;
            $pdo = $db->connect();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }

        $username = $_SESSION['username'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = $pdo->query($sql);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $password = $user['pass'];

        if($_POST) {

            $user = new User($username, $password);

            if (!empty($_POST['firstname'])) {
                $firstName = $_POST['firstname'];
                $user->changeFirstName($firstName);
            }
            if (!empty($_POST['lastname'])) {
                $lastName = $_POST['lastname'];
                $user->changeLastName($lastName);
            }
            $this->view('profile_view');
        }
    }
}