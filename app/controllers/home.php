<?php

class Home extends Controller {
    public function index() {
        $this->view('home_view');
        //$user = $this->model('User');
    }

    public function createGridElement($gridID, $link) {
        
    }
}