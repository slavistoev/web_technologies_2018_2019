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
                $dir = dirname(dirname(__FILE__));
                include_once $dir . '\models\database.php';
                $vars = $dir . '\include\vars.php';
            
                $db = new Database;
                $pdo = $db->connect($vars);
            } catch (Exception $e) {
                echo $e->getTraceAsString();
            }




            if($_POST) {
                //directory for photos
                $target = "images/";
                $target = $target . basename($_FILES['img']['name']);
                $pic = ($_FILES['img']['name']);

                $link = $_POST['link'];
                $text = $_POST['text'];
                $id = $_GET['id'];
                $empty = 1;

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
                
                header("Location: ./home_view");

                $db->closeConnection($pdo);
            }
        }
    }
}

?>