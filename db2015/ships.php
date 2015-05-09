<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	$sort_on = $_GET['sort_on'];
	if (! in_array($sort_on,array('ship_id','ship_name','DOS'))){
		header("Location:error.php");
	}
?>
<div class="hoverclass">
	<table>
            <tr><th><a href= 'ships.php?sort_on=ship_id'>Ship id</a></th><th><a href='ships.php?sort_on=ship_name'> Ship name</a></th><th>Type</th><th><a href='ships.php?sort_on=DOS'>Days on sea</a></th></tr>
<?php
	// Door gebruik te maken van ShipMapper en de functie findAll
	// creëren we een variabele die alle ships omvat.
	// We herbenoemen de variabele allShip naar ship en selecteren
	// telkens één element ervan. Voor elk element maken we een nieuwe
	// rij in de tabel met de bijbehorende eigenschappen van het element.
	// TODO COMMENTAAR UPDATE_SHIP
    require_once( "gb/mapper/ShipMapper.php" );
    $mapper = new gb\mapper\ShipMapper();//
	if (in_array($sort_on,array('ship_id','ship_name'))){
	$allShip = $mapper->findAllSortOn($sort_on);}
	else{
		$allShip = $mapper->findAll();
		usort($allShip,function($a,$b){
			if ($a->getDaysOnSea() == $b->getDaysOnSea() ){
				return $a->getShipId()<$b->getShipId() ?-1:1;
			}
			return ($a->getDaysOnSea()>$b->getDaysOnSea()) ?-1:1;
		});
	}
    foreach($allShip as $ship) {
 ?>
       <tr>
           <td><a href = 'update_ship.php?ship_id=<?php echo $ship->getShipId(); ?>&type=<?php echo $ship->getType(); ?>&name=<?php echo $ship->getShipName(); ?>'><?php echo $ship->getShipId(); ?></td>
		<td><a href = 'ship_info.php?ship_id=<?php echo $ship->getShipId(); ?>&sort_on=DD'><?php echo $ship->getShipName(); ?></a></td>
		<td><?php echo $ship->getType(); ?></td>     
		<td><?php echo $ship->getDaysOnSea();?></td>
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