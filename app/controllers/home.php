<?php

session_start();

class Home extends Controller {
    public function index() {
        if ($_SESSION) {
            if($_SESSION["username"]) {
               echo "Welcome User " . $_SESSION["username"];
            } else {
                echo "error username";
            }
        } else {
            echo "No user is currently logged.";
        }

        $this->view('home_view');

    }

    public function createGridElement($gridID, $link) {
        
    }
}