<?php require_once 'includes/require.php'; ?>
<?php
if ($session->is_logged_in()) {
    $user = Customer::findById($session->user_id);
} else {
    header("Location: index.php");
    exit;
}

if (isset($_POST['addToCart'])) {
    $product = Model_Product::findById($_POST['product_id']);

    if (isset($_SESSION['cart'])) {
        if (array_key_exists($product->id, $_SESSION['cart'])) {
            $_SESSION['cart'][$product->id] += 1;
        } else {
            $_SESSION['cart'][$product->id] = 1;
        }
    } else {
        $_SESSION['cart'][$product->id] = 1;
    }
}

if(isset($_POST['item_id'])){
    unset($_SESSION['cart'][$_POST['item_id']]);
}

$ids = array();
foreach ($_SESSION['cart'] as $key => $value) {
    $ids[] = $key;
}
$allProducts = array();
foreach ($ids as $id){
    $allProducts[] = Model_Product::findById($id);
}

if(array_key_exists("addToCart", $_POST)){
    header("Location: cart.php");
    exit;
}
?>
<?php require_once 'includes/header.php'; ?>
<div class="container">
<header class="hero-unit" >
    <h1> Web Store </h1>
    <h2> My Cart,<small style="color: #2CB7F2;"> <?php echo $user->fullname(); ?> </small> </h2>
</header>
    <table class="table">
    <tr>
        <th> Product name </th>
        <th> Barcode </th>
        <th> Quantity </th>
        <th> Price </th>
        <th>  </th>
    </tr>
    <?php foreach ($allProducts as $item) : ?>
        <tr> 
            <td> <?php echo $item->name ?>  </td>
            <td> <?php echo $item->barcode ?>  </td>
            <td> <?php echo $_SESSION['cart'][$item->id] ?>  </td>
            <td> <?php echo $item->price . "$" ?>  </td>
            <td> 
                <form action="cart.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $item->id ?>" />
                    <input class="btn btn-danger" type="submit" name="remove" value="Remove" />
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td></td> <td></td> <td></td>
            <td> Total: 
                <?php
                    $total = 0;
                    foreach ($allProducts as $item){ 
                        $total += $_SESSION['cart'][$item->id] * $item->price;  
                    }
                    echo $total. "$";
                ?>
            </td>
        </tr>
    </table>
    <form action="checkout.php" method="POST">
          <input class="btn btn-primary btn-large" type="submit" name="checkout" value="Checkout" />
      </form>
</div>
<?php require_once 'includes/footer.php'; ?>