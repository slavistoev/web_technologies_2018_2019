<?php

class Delete extends Controller {
    
    public function index() {
        session_start();

        if (!isset($_SESSION["username"])) {
            $message = "You have to be logged in!";
            echo "<script type='text/javascript'>alert('$message');";
            echo 'window.location.href="./login";';
            echo "</script>";
        } else {
            $this->model('Pixel');
            $this->view("profile_view");

            $id = $_GET['id'];
            $pixel = new Pixel($id);
            $result = $pixel->selectPixel();
            $msg = '';
            if ($result['success']) {
                $result = $pixel->deletePixel();
                if ($result['success']) {
                    $msg = "Pixel deleted successfully";
                } else {
                    $msg = result['error'];
                }
            } else {
                $msg = $result['error'];
            }

            echo $msg;
        }
    }
}

?>