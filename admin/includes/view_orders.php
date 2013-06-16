<table id="search">
    <tr>
        <th> Order ID </th>
        <th> Ordered products </th>
        <th> Quantity </th>
        <th> Price of each product </th>
        <th> Total price </th>
        <th> Shipping address </th>
        <th> Payment method </th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr> 
            <td> <?php echo $order->id ?></td>
            <td> 
                <?php
                for ($i = 0; $i < count($order->items); $i++) {
                    echo $order->items[$i]->name . "<br />";
                }
                ?> 
            </td>
            <td> 
                <?php
                for ($i = 0; $i < count($order->items); $i++) {
                    echo $order->items[$i]->qty . "<br />";
                }
                ?> 
            </td>
            <td> 
                <?php
                for ($i = 0; $i < count($order->items); $i++) {
                    echo $order->items[$i]->price . "$<br />";
                }
                ?> 
            </td>
            <td> <?php echo $order->total_price . "$" ?></td>
            <td> <?php echo $order->shipping_info; ?> </td>
           <td> <?php echo $order->payment_info; ?> </td>
        </tr>
    <?php endforeach; ?>
</table>
