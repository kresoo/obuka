<?php

if (isset($_GET['viewOrders'])) {
    echo "All orders <br /> <hr />";
    $orders = Order::findAll();
    foreach ($orders as $order){
        $order->items = unserialize($order->items);
    }
    require 'includes/view_orders.php';
}
?>
