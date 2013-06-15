<form action="includes/process_changes.php" method="POST">
    Create new product: <br /> <hr />
    Name:<br />
    <input type="text" name="name"  /><br />
    Description:<br />
    <input type="text" name="description" /><br />
    Price:<br />
    <input type="text" name="price" /><br />
    Barcode:<br />
    <input type="text" name="barcode" v/><br />
    Quantity:<br />
    <input type="text" name="qty" /><br />
    Category: <br />
    <select multiple name="category_id[]">
        <?php
        $allCategories = Category::findAll();
        foreach ($allCategories as $category):
            ?>
            <option value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>
        <?php endforeach; ?>

    </select> <br /><br />
    <input type="submit" name="create_product" value="Save" />
</form>
