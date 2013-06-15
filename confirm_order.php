<?php require_once 'includes/require.php'; ?>
<?php
echo "<pre>";
    $message = "";
    if(isset($_POST['order_confirm'])){
       $order = new Order();
       $order->total_price = $_POST['total_price'];
       $order->items=$_POST['items'];
       $order->customer_info=$_POST['customer_info'];
       $order->shipping_info=$_POST['shipping_info'];
       $order->payment_info=$_POST['payment_info'];
       $order->user_id=$_POST['user_id'];
       //print_r($order);
       $qty_id = array();
        foreach ($_SESSION['cart'] as $id => $qty){
            $qty_id[$id] = $qty;
        }
        $success = 0;
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
<?php require_once 'includes/header.php'; ?>

<?php require_once 'includes/footer.php'; ?>