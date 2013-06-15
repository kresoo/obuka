<?php require_once 'includes/require.php'; ?>
<?php 
    if($session->is_logged_in()){
        $user = Customer::findById($session->user_id);
        $login = "";
        $fullname = "Hello " . $user->fullname();
        $logout = "<a href=\"logout.php\"> Logout </a>";
        $myAccount = "<a href=\"myaccount.php\">| My Account </a>";
    } else {
        $login = "<a href=\"login.php\"> Log in | Register </a>";
        $fullname = "";
        $logout = "";
        $myAccount = "";
    }
    $categories = Category::findAll();
    $products = array();
    if(!empty($_GET['category_id'])){
        $catId = $_GET['category_id'];
        $allProd = Product::findAll();
        foreach ($allProd as $product){
            $prodCatTemp = $product->category_id;
            $prodCat = explode(",", $prodCatTemp);
            foreach ($prodCat as $key => $value){
                if($value == $catId){
                    $products[] = $product;
                }
            }
        }
    }
    
?>
<?php require_once 'includes/header.php'; ?>
        <h1> Web Store </h1>
        <div> <?php echo $fullname . "<br />"; echo $logout ; echo $myAccount ?> </div>
        <div> <?php echo $login ?> </div>
        <br />
        <ul>
            <?php foreach ($categories as $category): ?>
                <li style="display: inline-block;margin-right: 10px;"> <a href="index.php?category_id=<?php echo $category->id ?>"> <?php echo $category->name; ?> </a>  </li>
            <?php endforeach;?>
        </ul>
        <?php if(!empty($products)){ ?>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li> <a href="productView.php?product_id=<?php echo $product->id ?>"> <?php echo $product->name ?>  </a> </li>
                <?php endforeach; ?>
            </ul>
        <?php } else { $allProducts = Product::findRandomProducts(5); ?>
            <?php foreach ($allProducts as $product): ?>
                  <div style="border: 1px solid grey;padding:5px;width:300px;float:left;"> 
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
            <?php endforeach; ?>
        <?php } ?>

<?php require_once 'includes/footer.php'; ?>