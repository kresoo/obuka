<?php
if (!empty($products)) {
    echo "All products <br /> <hr />";
    ?>
    <table class="display">
        <?php foreach ($products as $product) {
            ?>
            <tr>
                <td> <?php echo $product->name; ?> </td> 
                <td> <a href="admin_main.php?pid=<?php echo $product->id ?>"  > <b> Edit product </b> </a> </td>
            </tr>
    <?php } ?>
    </table>
<?php
}?>