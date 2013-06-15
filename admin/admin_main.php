<?php require_once 'includes/require.php'; ?>
<?php
if (!$session->is_logged_in()) {
    header("Location: index.php");
    exit;
}
?>
<?php $admin = Admin::findById($session->admin_id) ?>
<?php require_once 'includes/admin_process.php'; ?>
<?php require_once 'includes/header.php'; ?>
<div id="welcome">
    <h3>Hello <?php echo $admin; ?>,&nbsp;<a href="includes/logout.php" style="color:#2CB7F2;text-decoration: none;">  Logout </a> </h3><br /><br />
</div>
<div id="navigation">
    Options:
    <ul>
        <li><a href="admin_main.php?allCat" style="text-decoration: none;"> All categories </a><br /></li>
        <li><a href="admin_main.php?allProd" style="text-decoration: none;"> All products </a><br /></li>
        <li><a href="admin_main.php?createCat" style="text-decoration: none;"> Create category </a><br /></li>
        <li><a href="admin_main.php?createProd" style="text-decoration: none;"> Create product </a></li>
        <li><a href="admin_main.php?viewOrders" style="text-decoration: none;"> View all orders </a></li>
        <li><a href="admin_main.php?searchOrders" style="text-decoration: none;"> Search orders </a></li>
    </ul>
</div>
<div>
    <div id="main">
        
        <?php require_once 'includes/view_categories.php'; ?>
        <?php require_once 'includes/view_products.php'; ?>
        <?php require_once 'includes/view_edit_category.php'; ?>
        <?php require_once 'includes/view_edit_product.php'; ?>
        <?php require_once 'includes/view_create_category.php'; ?>
        <?php require_once 'includes/view_create_product.php'; ?>
        <?php require_once 'includes/view_all_orders.php'; ?>
        <?php require_once 'includes/view_search_orders.php'; ?>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
