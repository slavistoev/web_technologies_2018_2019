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
            $user = $_SESSION["username"];

            try {
                $dir = dirname(dirname(__FILE__));
                include_once $dir . '\models\database.php';
                $vars = $dir . '\include\vars.php';
            
                $db = new Database;
                $pdo = $db->connect($vars);
            } catch (Exception $e) {
                echo $e->getTraceAsString();
            }

            $id = $_GET['id'];
            
            $sql = "UPDATE grid SET empty=1, link='NULL', text='NULL', owner='NULL', img='NULL' WHERE id='$id'";
            $pdo->query($sql);
            
            $this->view("profile_view");

            $db->closeConnection($pdo);
        }
    }
}

?>