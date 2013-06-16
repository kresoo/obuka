<?php require_once 'includes/require.php'; ?>
<?php
     
    if(isset($_POST['order_confirm'])){
        
            if(empty($_POST['shipping_info'])){
                $session->message("You must provide shipping address.");
                redirect("checkout.php");
            }
            if(empty($_POST['payment_info'])){
                $session->message("You must provide payment info.");
                redirect("checkout.php");
            }
        
       $order = new Order();
       $order->total_price = $_POST['total_price'];
       $order->items=$_SESSION['items'];
       $order->customer_info=$_SESSION['customer_info'];
       $order->shipping_info=$_POST['shipping_info'];
       $order->payment_info=$_POST['payment_info'];
       $order->user_id=$_POST['user_id'];
       unset($_SESSION['items']);
       unset($_SESSION['customer_info']);
       //print_r($order);
       $qty_id = array();
        foreach ($_SESSION['cart'] as $id => $qty){
            $qty_id[$id] = $qty;
        }
        global $database;
        if($order->insert()){
            foreach ($qty_id as $id => $qty){
                $sql = "UPDATE product SET qty = qty - " .$qty . " WHERE id = " . $id;
                $database->query($sql);
            }
            $_SESSION['cart'] = "";
            $message = "You order has been successfully processed";
            header("Location: index.php");
            exit;
        } else {
            $message = "There was an error with your order.";
            header("Location: cart.php");
            exit;
        }
    }
?>
