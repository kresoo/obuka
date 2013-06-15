<form action="includes/process_changes.php" method="POST">
    New category name: <br /> <hr style=""/>
    <input type="text" name="category_name" value="<?php echo $category->name ?>"/>
    <input type="hidden" name="category_id" value="<?php echo $category->id ?>" />
    <input type="submit" name="category_change" value="Save" />
</form>

