<?php

session_start();

class Logout extends Controller {
    public function index() {
        if ($_SESSION) {
            session_unset();
            session_destroy();
    
            $this->view('home_view');
        } else {
            echo "Грешка...";
        }
    }
}