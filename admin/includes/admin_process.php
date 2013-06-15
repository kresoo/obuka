<?php

if (isset($_GET['allCat'])) {
    $categories = Category::findAll();
} else {
    $categories = "";
}

if (isset($_GET['allProd'])) {
    $products = Product::findAll();
} else {
    $products = "";
}
?>