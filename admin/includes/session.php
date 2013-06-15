<?php

class Session {

    private $logged_in;
    public $admin_id;
    public $message;

    public function __construct() {
        session_start();
        $this->check_login();
        $this->check_message();
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($user) {
        $this->admin_id = $_SESSION['admin_id'] = $user->id;
        $this->logged_in = true;
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        $_SESSION['cart'] = "";
        unset($this->admin_id);
        $this->logged_in = false;
    }

    private function check_login() {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
    }

    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

}

$session = new Session();
$message = $session->message;
?>