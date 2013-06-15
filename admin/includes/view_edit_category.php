<?php

if (isset($_GET['cid'])) {
    $category = Category::findById($_GET['cid']);
    echo "Change name for category <span style=\"color:#2CB7F2\">" . $category->name . "</span> <br /> <br /> ";
    require_once 'includes/change_cat_name.php';
    echo $message;
}
?>
