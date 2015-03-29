<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of shipments";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	
	// Door gebruik te maken van ShipmentMapper en de functie findAll
	// creëren we een variabele die alle shipments omvat.
	require_once( "gb/mapper/ShipmentMapper.php" );
    $mapper = new gb\mapper\ShipmentMapper();//
    $allShipment = $mapper->findAll();
?>
<div class = "hoverclass">
<table>
    <tr>
        <th>Shipment id</th>
        <th>Volume</th>
        <th>Weight</th>        
    </tr>
<?php
	// We herbenoemen de variabele allShipment naar shipment en selecteren
	// telkens één element ervan. Voor elk element maken we een nieuwe
	// rij in de tabel met de bijbehorende eigenschappen van het element.
	foreach($allShipment as $shipment) {
?>
	<tr>
		<td><?php echo $shipment->getShipmId(); ?></td>
		<td><?php echo $shipment->getVolume(); ?></td>
		<td><?php echo $shipment->getWeight(); ?></td>
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