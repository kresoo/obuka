<?php require_once 'includes/require.php'; ?>
<?php
      if(isset($_GET['product_id'])){
          $product = Model_Product::findById($_GET['product_id']);
      }  
?>
<?php require_once 'includes/header.php'; ?>
    <div class="container">
        <header class="hero-unit">
        <h1> Web Store </h1>
        </header>
        <div style="border: 1px solid #CFCFCF;padding:5px;width:250px;padding: 20px;margin-bottom: 30px;"> 
            <h2 style="color:#2CB7F2"> <?php echo $product->name ?> </h2>
            <hr />
            About product: <br />
            <ul>
                <li> Description: </li>
                <ul>
                    <li style="list-style: none;"> <?php echo $product->description ?> </li>
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
            <input class="btn btn-large btn-primary" type="submit" name="addToCart" value="Add to cart" />
        </form>
    <?php } ?>
 
        </div>
<?php require_once 'includes/footer.php'; ?>

