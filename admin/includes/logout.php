<?php

require_once 'require.php';
$session->logout();
header("Location: ../index.php");
exit;
?>

