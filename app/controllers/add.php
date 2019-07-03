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

        
        $id = $_GET['id'];
    }
}

?>