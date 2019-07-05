<?php

class Add extends Controller {
    
    public function index() {
        session_start();

        if (!isset($_SESSION["username"])) {
            $message = "You have to be logged in!";
            echo "<script type='text/javascript'>alert('$message');";
            echo 'window.location.href="./login";';
            echo "</script>";
        } else {
            $user = $_SESSION["username"];
            $this->view("add_view");
            $this->model('Pixel');

            if($_POST) {
                //directory for photos
                $target = "images/";
                $target = $target . basename($_FILES['img']['name']);
                $pic = ($_FILES['img']['name']);

                $link = $_POST['link'];
                $text = $_POST['text'];
                $id = $_GET['id'];

                $pixel = new Pixel($id);
                $result = $pixel->selectPixel();
                if ($result['success']) {
                    if (!$pixel->isEmpty()) {
                        echo "pixel is taken";
                    }
                    else {
                        if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                            echo "The file has been uploaded.";

                            $result = $pixel->updatePixel($pic, $link, $user, $text);
                            if ($result['success']) {
                                header("Location: ./home_view");
                            } else {
                                echo result['error'];
                            }
                        } else {
                            echo "The file has not been uploaded.";
                        }
                    }

                } else {
                    echo result['error'];
                }            
            }
        }
    }
}

?>