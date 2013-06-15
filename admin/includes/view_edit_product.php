<?php

if (isset($_GET['pid'])) {
    $product = Product::findById($_GET['pid']);
    echo "Change properties of product <span style=\"color:#2CB7F2\">" . $product->name . "</span> <br /> <br /> ";
    require_once 'includes/change_prod_properties.php';
    echo $message;
}
?>
