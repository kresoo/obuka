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
<h1> Web Store </h1>
<h2> My Account </h2>
<div>
    <b> Name: </b> <br />
    <div> <?php echo $user->firstname ?> </div> <br />
    <b>Lastname:</b> <br />
    <div> <?php echo $user->lastname ?> </div> <br />
    <b>Email address:</b> <br />
    <div> <?php echo $user->email ?> </div> <br />
    <b> Orders: </b> <br />
    <table>
        <th> Order ID </th>
        <th> Products </th>
        <th> Quantity </th>
        <th> Price of each product </th>
        <th> Total price </th>
        <?php foreach ($orders as $order): ?>
            <tr> 
                <td style="border:1px solid red;"> 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->name . "<br />";
                        } 
                    ?> 
                </td>
                <td style="border:1px solid red;"> 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->qty . "<br />";
                        } 
                    ?> 
                </td>
                <td style="border:1px solid red;"> 
                    <?php 
                        for($i=0;$i<count($order->items);$i++){
                             echo $order->items[$i]->price . "<br />";
                        } 
                    ?> 
                </td>
                <td style="border:1px solid red;"> <?php echo $order->total_price; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<br />
<a href="index.php">&laquo; Back to Home </a>
<?php require_once 'includes/footer.php'; ?>

