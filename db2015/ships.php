<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
?>
<div class="hoverclass">
	<table>
            <tr><th>Ship id</th><th>Ship name</th><th>type</th></tr>
<?php
    require_once( "gb/mapper/ShipMapper.php" );
    $mapper = new gb\mapper\ShipMapper();//
    $allShip = $mapper->findAll();
    foreach($allShip as $ship) {
 ?>
       <tr>
           <td><a href = 'update_ship.php?ship_id=<?php echo $ship->getShipId(); ?>&type=<?php echo $ship->getType(); ?>&name=<?php echo $ship->getShipName(); ?>'><?php echo $ship->getShipId(); ?></td>
		<td><?php echo $ship->getShipName(); ?></td>
		<td><?php echo $ship->getType(); ?></td>                
	</tr>     
<?php        
}
?>
	

</table>
</div>
<?php
	require("template/bottom.tpl.php");
?>