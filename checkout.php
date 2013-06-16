<?php require_once 'includes/require.php'; ?>
<?php
if ($session->is_logged_in()) {
    $user = Customer::findById($session->user_id);
} else {
    header("Location: index.php");
    exit;
}
$ids = array();
if (isset($_POST['checkout'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $ids[] = $key;
    }
}

$products = array();
foreach ($ids as $id) {
    $products[] = Product::findById($id);
}
?>
<?php require_once 'includes/header.php'; ?>
<div class="container">
<header class="hero-unit">
    <h1> Web Store </h1>
    <h2> Order <span style="color:#2CB7F2;">confirmation </h2>
</header>
<div style="border: 1px solid grey;width:500px;padding:20px;margin:0 auto;">
    <form action="confirm_order.php" method="POST">
        <ul>
            <li> Products: </li>
            <ul>
                <table class="table">
                    <tr>
                        <th > Name </th>
                        <th> Barcode </th>
                        <th> Quantity </th>
                        <th> Price </th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr> 
                            <td style="color:#2CB7F2;"> <?php echo $product->name ?> </td>
                            <td> <?php echo $product->barcode ?> </td>
                            <td> <?php echo $_SESSION['cart'][$product->id] ?> </td>
                            <td> <?php echo $product->price . "$" ?> </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    foreach ($products as $product) {
                        foreach ($ids as $id){
                            if($product->id == $id){
                                $product->qty = $_SESSION['cart'][$product->id];
                            }
                        }
                    }
                    $serializedProds = serialize($products);
                    $_SESSION['items'] = $serializedProds;
                    ?>
                </table>
                

            </ul>
            <br />
            <li> Total price: </li>
            <ul> 
                <?php
                $total = 0;
                foreach ($products as $item) {
                    $total += $_SESSION['cart'][$item->id] * $item->price;
                }
                echo "<span style=\"color:#2CB7F2;\">" . $total . "$ </span>";
                ?>
                <input type="hidden" name="total_price" value="<?php echo $total ?>" />
            </ul>
            <br />
            <li> Customer info: </li>
            <ul>
                <?php echo "<span style=\"color:#2CB7F2;\">" . $user->fullname() . " </span>" ?> <br />
                <?php echo "<span style=\"color:#2CB7F2;\">" . $user->email . " </span>" ?> <br />
                <?php
                $customer_info = array();
                $customer_info[] = $user->fullname();
                $customer_info[] = $user->email;
                $_SESSION['customer_info'] = serialize($customer_info);
                ?>
            </ul>
            <br />
            <li> Shipping info </li>
            <ul>
                <textarea name="shipping_info" rows="10" cols="30" placeholder="Enter shipping address"></textarea>
            </ul>
            <br />
            <li> Payment info </li>
            <ul> 
                <table>
                    <tr>
                        <td>VISA </td>
                        <td> &nbsp;  </td>
                        <td>AMERICAN </td>
                    </tr>
                    <tr>
                        <td><input  type="radio" name="payment_info" value="visa" />  </td>
                        <td>&nbsp; </td>
                         <td> <input type="radio" name="payment_info" value="american" /> </td>
                    </tr>
                </table>
            </ul>
        </ul>
        <input type="hidden" name="user_id" value="<?php echo $user->id ?>" />
        </div> 
        <div style="margin: 0 auto;text-align: center;margin-top: 20px;">
        <input class="btn btn-large btn-primary" type="submit" name="order_confirm" value="Confirm payment" />  
        </div>
    </form>
    <div style="text-align: center;">  <?php echo $session->message; ?> </div>

<?php require_once 'includes/footer.php'; ?>