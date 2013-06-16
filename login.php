<?php require_once 'includes/require.php'; ?>
<?php
$message = "";
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $found_user = Customer::authenticate($username, $password);
    if ($found_user) {
        $session->login($found_user);
        header("Location: index.php");
        exit;
    } else {
        $message = "Invalid username or password";
    }
}
if (isset($_POST['register'])) {
    $values = array();
    foreach ($_POST as $key => $value) {
        $values[$key] = $value;
    }
    $user = new Customer();
    if($user->attachObjectAttributes($values)){
        if ($user->insert()) {
            $message = "You have successfully registered. You can now log in."; 
        } 
    }else {
        $message = join("<br />", $user->errorArray);
    }
}
?>
<?php require_once 'includes/header.php'; ?>
<div class="container">
     <header class= "hero-unit">
        <h1> Web Store </h1>
    </header>
    <div style="margin:0 auto;width:600px;">
    <div style="float:left;">
        <h3> Log in: </h3>
        <form action="login.php" method="POST">
            Username: <br />
            <input type="text" name="username" /> <br /> <br />
            Password: <br />
            <input type="password" name="password" /> <br /> <br />
            <input class="btn btn-primary" type="submit" name="login" value="Log in" />
        </form>
    </div>
    <div style="float:left;margin-left: 40px;margin-right: 40px;padding-top:150px;"> <h2>or</h2>  </div>
    <div style="float:left;">
        <h3>Register: </h3>
        <form action="login.php" method="POST">
            Firstname: <br />
            <input type="text" name="firstname" /> <br /> <br />
            Lastname: <br />
            <input type="text" name="lastname" /> <br /> <br />
            Username: <br />
            <input type="text" name="username" /> <br /> <br />
            Password: <br />
            <input type="password" name="password" /> <br /> <br />
            Email: <br />
            <input type="text" name="email" /> <br /> <br />
            <input class="btn btn-primary" type="submit" name="register" value="Register" />
        </form>
    </div>
    <div style="clear:both;text-align: center;"> <?php echo $message ?> </div>
    <br /> <br />
    </div>
    <a href="index.php"> &laquo; Back to Home </a>
</div>
<?php require_once 'includes/footer.php'; ?>

