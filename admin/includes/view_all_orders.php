<?php

if (isset($_GET['viewOrders'])) {
    echo "All orders <br /> <hr />";
    $orders = Order::findAll();
    require 'includes/view_orders.php';
}
?>
