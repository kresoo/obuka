<?php
if (!empty($categories)) {
    echo "All categories <br /> <hr />";
    ?>
    <table class="display">
        <?php foreach ($categories as $category) {
            ?>
            <tr>
                <td> <?php echo $category->name; ?> </td> 
                <td> <a href="admin_main.php?cid=<?php echo $category->id ?>"  > <b> Change name </b> </a> </td>
            </tr>
    <?php } ?>
    </table>
<?php
}?>