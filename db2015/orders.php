<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	require_once( "gb/mapper/OrdersMapper.php" );
    $mapper = new gb\mapper\OrdersMapper();//
    $allOrder = $mapper->findAll();
?>
<div class="hoverclass">
<table>
    <tr>
        <th>Shipment id</th>
        <th>Customer ssn</th>
        <th>Ship broker name</th>
        <th>Price</th>
        <th>Order date</th>
    </tr>
<?php
    foreach($allOrder as $order) {
 ?>
       <tr>
		<td><?php echo $order->getShipmId(); ?></td>
		<td><?php echo $order->getCustomerSsn(); ?></td>
		<td><?php echo $order->getShipBrokerName(); ?></td>
                <td><?php echo $order->getPrice(); ?></td>
                <td><?php echo $order->getOrderDate(); ?></td>
	</tr>     
<?php        
}
?>
</table>  
</div>
<?php
	require("template/bottom.tpl.php");
?>