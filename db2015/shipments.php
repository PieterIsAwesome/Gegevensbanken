<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
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
	require("template/bottom.tpl.php");
?>