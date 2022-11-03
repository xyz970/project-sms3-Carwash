<?php
class AdminController {

    public function __construct() {
        session_start();
        if (!$_SESSION['user']) {
            header("Location: ".BASE_URL."?error=true&message=Anda harus login");
        }
    }
    public function getIndex()
    {
        print_r($_SESSION['user']['email']);
    }
}