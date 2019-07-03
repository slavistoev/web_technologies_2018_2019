<?php

class GetGridElement extends Controller {
    
    public function index() {
        $id = $_GET['id'];
        echo $id;
        $this->view("getElement_view");
    }
}

?>