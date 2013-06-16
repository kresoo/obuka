<?php require_once 'includes/require.php'; ?>
<?php
if ($session->is_logged_in()) {
    $user = Customer::findById($session->user_id);
    $orders = Order::findOrdersByUserId($user->id);
} else {
    header("Location index.php");
}
foreach ($orders as $order){
    $order->items = unserialize($order->items);
}

?>
<?php require_once 'includes/header.php'; ?>
<div class="container">
<header class="hero-unit">
    <h1> Web Store </h1>
    <h2> My <span style="color:#2CB7F2;"> Account </span> </h2>
</header>
<div style="width:600px;margin: 0 auto;">
    <h3> Name: </h3> 
    <div><span style="color:#2CB7F2;"> <?php echo $user->firstname ?> </span></div> <br />
    <h3>Lastname:</h3> 
    <div> <span style="color:#2CB7F2;"><?php echo $user->lastname ?> </span></div> <br />
    <h3>Email address:</h3> 
    <div> <span style="color:#2CB7F2;"><?php echo $user->email ?> </span></div> <br />
    <h3> Orders: </h3> <br />
    <table class="table table-bordered">
        
        <th> Products </th>
        <th> Quantity </th>
        <th> Price of each product </th>
        <th> Total price </th>
        <?php foreach ($orders as $order): ?>
            <tr> 
                <td > 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->name . "<br />";
                        } 
                    ?> 
                </td>
                <td > 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->qty . "<br />";
                        } 
                    ?> 
                </td>
                <td > 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->price . "$<br />";
                        } 
                    ?> 
                </td>
                <td > <?php echo $order->total_price . "$"; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
    <a href="index.php">&laquo; Back to Home </a>
</div>
<?php require_once 'includes/footer.php'; ?>

