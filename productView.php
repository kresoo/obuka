<?php require_once 'includes/require.php'; ?>
<?php
      if(isset($_GET['product_id'])){
          $product = Product::findById($_GET['product_id']);
      }  
?>
<?php require_once 'includes/header.php'; ?>
    <h1> Web Store </h1>
    <div style="border: 1px solid grey;padding:5px;width:300px;"> 
        <h2> <?php echo $product->name ?> </h2>
        <hr />
        About product: <br />
        <ul>
            <li> Description: </li>
            <ul>
                <li style="list-style: none;"> <?php echo $product->desc ?> </li>
            </ul>
        </ul>
        <ul>
            <li> Price: </li>
            <ul>
                <li style="list-style: none;"> <?php echo $product->price . "$" ?> </li>
            </ul>
        </ul>
        <ul>
            <li> Barcode: </li>
            <ul>
                <li style="list-style: none;"> <?php echo $product->barcode ?> </li>
            </ul>
        </ul>
        <ul>
            <li> In stock: </li>
            <ul>
                <li style="list-style: none;"> <?php echo $product->qty ?> </li>
            </ul>
        </ul>
    </div>
    <?php if($session->is_logged_in()){ ?>
        <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product->id ?>" />
            <input type="submit" name="addToCart" value="Add to cart" />
        </form>
    <?php } ?>
<?php require_once 'includes/footer.php'; ?>

