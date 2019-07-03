<?php

class Add extends Controller {
    
    public function index() {
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
                
                $sql = "UPDATE grid SET empty=0, link='$link', text='$text' WHERE id='$id'";
                $pdo->query($sql);
            }

            $db->closeConnection($pdo);
        }
    }
}

?>