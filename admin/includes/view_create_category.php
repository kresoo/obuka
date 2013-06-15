<?php

if (isset($_GET['createCat'])) {
    require_once 'includes/create_category.php';
    echo $message;
}
?>
