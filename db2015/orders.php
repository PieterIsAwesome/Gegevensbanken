<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	
	// Door gebruik te maken van OrdersMapper en de functie findAll
	// creëren we een variabele die alle orders omvat.
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
	// We herbenoemen de variabele allOrder naar order en selecteren
	// telkens één element ervan. Voor elk element maken we een nieuwe
	// rij in de tabel met de bijbehorende eigenschappen van het element.
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
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>