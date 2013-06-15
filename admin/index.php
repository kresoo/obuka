<?php require_once 'includes/require.php'; ?>
<?php
if ($session->is_logged_in()) {
    header("Location: admin_main.php");
    exit;
}
?>
<?php require_once 'includes/login_process.php'; ?>
<?php require_once 'includes/header.php'; ?>
<div style="margin:50px auto;padding:10px;width:450px;">
    <h1 style="text-align: center;"> Web Store <span style="color:#2CB7F2"> Admin </span> area  </h1>
    <hr /> <br />
    <div style="margin:0 auto;width:200px;">
        <span style="color:#2CB7F2;font-size: 20px;"> Log in: </span> <br /> <br />
        <form action="index.php" method="POST">
            Username:<br />
            <input type="text" name="username" /> <br /> <br />
            Password: <br />
            <input type="password" name="password" /> <br /> <br />
            <input type="submit" name="login" value="Log in" />
        </form>
    </div>
    <div style="text-align: center;margin-top: 10px;"><?php echo $message; ?> </div>
</div>
<?php require_once 'includes/footer.php'; ?>
