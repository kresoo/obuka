<?php

if (!empty($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $found_user = Admin::authenticate($username, $password);

    //var_dump($found_user);
    if ($found_user) {
        $session->login($found_user);
        redirect("admin_main.php");
    } else {
        $session->message("Invalid username of password");
        redirect("index.php");
    }
}
?>
