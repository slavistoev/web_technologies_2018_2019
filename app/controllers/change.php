<?php

class Change extends Controller {
    
    public function index() {
        session_start();

        if (!isset($_SESSION["username"])) {
            $message = "You have to be logged in!";
            echo "<script type='text/javascript'>alert('$message');";
            echo 'window.location.href="./login";';
            echo "</script>";
        } else {
            $user = $_SESSION["username"];
            $this->view("change_view");
            $this->model('Pixel');

            $id = $_GET['id'];

            $pixel = new Pixel($id);
            $result = $pixel->selectPixel();
            $error = '';
            if ($result['success']) {
                if($_POST) {   
                    if (!empty($_POST['link'])) {
                        $link = $_POST['link'];
                    } else {
                        $link = $pixel->getLink();
                    }
                    if (!empty($_POST['text'])) {
                        $text = $_POST['text'];
                    } else {
                        $text = $pixel->getText();
                    }
                    if (!empty($_FILES['img']['name'])) {
                        //directory for photos
                        $target = "images/";
                        $target = $target . basename($_FILES['img']['name']);
                        $pic = ($_FILES['img']['name']);
                    } else {
                        $pic = $pixel->getImg();
                    }
    
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                        $error = "The file has been uploaded.";

                        $result = $pixel->updatePixel($pic, $link, $user, $text);
                        if ($result['success']) {
                            header("Location: ./home_view");
                        } else {
                            $error = result['error'];
                        }
                    } else {
                        $error = "The file has not been uploaded.";
                    }
                }
            } else {
                $error = $result['error'];
            }

            echo $error;
        }
    }
}

?>