<?php

if (isset($_GET['createProd'])) {
    require 'includes/create_product.php';
    echo $message;
}
?>
