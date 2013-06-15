<?php require_once 'includes/require.php'; ?>
<?php
if ($session->is_logged_in()) {
    $user = Customer::findById($session->user_id);
    $orders = Order::findOrdersByUserId($user->id);
} else {
    header("Location index.php");
}
$products = array();
//    echo "<pre>";
//    print_r($orders);
foreach ($orders as $order) {
    $items = $order->items;
    $items = explode("|", $items);
    $Items = array();
    for ($i = 0; $i < count($items) - 1; $i++) {
        $Items[] = explode(",", $items[$i]);
    }
    $products[] = $Items;
}
$numOfOrders = count($products);
//    echo "<pre>";
//   print_r($products);
static $total = 0;
$output = "";
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
        <?php for ($i = 0; $i < $numOfOrders; $i++): ?>
            <tr> <td style="background-color: black;color:white;">Order <?php echo ($i + 1); ?> <hr /> </td> </tr> 

            <?php foreach ($products[$i] as $product): ?>  
                <tr> <td> <?php echo $product[0] . "  ";
        echo $product[1] . "  ";
        echo $product[2] . "$  " ?> </td> </tr>   
            <?php endforeach; ?>
            <?php
            foreach ($products[$i] as $product) {
                $total += $product[2];
                $output = "<tr> <td> Total price: " . $total . " </td> </tr>";
            }
            ?>
    <?php echo $output;
    $output = "";
    $total = 0; ?>
<?php endfor; ?>
    </table>
</div>
<br />
<a href="index.php">&laquo; Back to Home </a>
<?php require_once 'includes/footer.php'; ?>

