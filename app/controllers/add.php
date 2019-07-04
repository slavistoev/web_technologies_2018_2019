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

            try {
                $db = new Database;
                $pdo = $db->connect();
            } catch (Exception $e) {
                echo $e->getTraceAsString();
            }




            if($_POST) {
                //directory for photos
                $target = "images/";
                $target = $target . basename($_FILES['img']['name']);

                echo $target;

                $link = $_POST['link'];
                $text = $_POST['text'];
                $id = $_GET['id'];
                $empty = 1;
                $pic = ($_FILES['img']['name']);

                $sql = "SELECT * FROM grid WHERE id='$id'";
                $row = $pdo->query($sql);

                $row->setFetchMode(PDO::FETCH_ASSOC);
                $r = $row->fetch();


                if ($r['empty'] == 0) {
                    echo "pixel is taken";
                }
                else {

                    $sql = "UPDATE grid SET empty=0, link='$link', text='$text', owner='$user', img='$pic' WHERE id='$id'";
                    $pdo->query($sql);

                    if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                        echo "The file has been uploaded.";
                    } else {
                        echo "The file has not been uploaded.";
                    }
                }

                $db->closeConnection($pdo);
            }
        }
    }
}

?>