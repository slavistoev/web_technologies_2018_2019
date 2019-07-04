<?php

session_start();

class Profile extends Controller {
    public function index() {
        $this->view('profile_view');

    }

}