<?php

$products = array();

foreach ($orders as $order) {
    $items = $order->items;
    $items = explode("|", $items);
    $orderItems = array();
    for ($i = 0; $i < count($items) - 1; $i++) {
        $orderItems[] = explode(",", $items[$i]);
    }
    $products[] = $orderItems;
}

$numOfOrders = count($products);
?>


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
            <?php $productTotal = "";$quantityTotal = "";$priceOfEachTotal = ""?>
            <?php  for($i=0;$i<$numOfOrders;$i++): ?>
                <tr> <td > <?php echo ($i+1); ?>  </td> 
                    <?php foreach($products[$i] as $product):?>  
                        <?php $productTotal .= $product[0] . "<br />" ?> 
                        <?php $quantityTotal .= $product[1]. "<br />" ?> 
                        <?php $priceOfEachTotal .= $product[2] ."$". "<br />"?> 
                    <?php endforeach; ?>
                    
                        <td> <?php echo $productTotal; $productTotal=""?> </td>
                        <td> <?php echo $quantityTotal; $quantityTotal=""?> </td>
                        <td> <?php echo $priceOfEachTotal; $priceOfEachTotal=""?> </td>
                        <td> <?php echo  $orders[$i]->total_price."$";?> </td>
                        <td> <?php echo $orders[$i]->shipping_info; ?> </td>
                        <td> <?php echo $orders[$i]->payment_info; ?> </td>
                </tr>
            <?php endfor;?>
        </table>
