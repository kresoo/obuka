<?php

if (isset($_GET['searchOrders'])) {
    require_once 'includes/search_orders.php';
    echo $message;
    if (!empty($_SESSION['search_result'])) {
        $orders = unserialize($_SESSION['search_result']);
        foreach ($orders as $order){
            $order->items = unserialize($order->items);
        }
        echo "<hr />Search results:<br />";
        require 'includes/view_orders.php';
        unset($_SESSION['search_result']);
    }
}
?>