<?php

session_start();

class Logout extends Controller {
    public function index() {
        if ($_SESSION) {
            session_unset();
            session_destroy();
    
            echo "Logged out";
        } else {
            echo "Грешка...";
        }
    }
}