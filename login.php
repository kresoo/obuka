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
    $user->attachObjectAttributes($values);
    if ($user->insert()) {
        $message = "You have successfully registered. You can now log in.";
    } else {
        $message = join("<br />", $user->errorArray);
    }
}
?>
<?php require_once 'includes/header.php'; ?>
<h1> Web Store </h1>
<div style="float:left;">
    Log in: <br /> <br />
    <form action="login.php" method="POST">
        Username: <br />
        <input type="text" name="username" /> <br /> <br />
        Password: <br />
        <input type="password" name="password" /> <br /> <br />
        <input type="submit" name="login" value="Log in" />
    </form>
</div>
<div style="float:left;margin-left: 50px;">
    Register: <br /> <br />
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
        <input type="submit" name="register" value="Register" />
    </form>
</div>
<div style="clear:both;"> <?php echo $message ?> </div>
<br /> <br />
<a href="index.php"> &laquo; Back to Home </a>
<?php require_once 'includes/footer.php'; ?>

