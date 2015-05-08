<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	require_once("gb/mapper/ShipMapper.php");
	require_once("gb/mapper/PortMapper.php");
	require_once("gb/mapper/ContainerMapper.php")
?>
<?php 	$shipMapper = new gb\mapper\ShipMapper();
		$portMapper = new gb\mapper\PortMapper();
		$containerMapper = new gb\mapper\ContainerMapper();
		$ship_id = $_GET['ship_id']; 
		$ship = $shipMapper->find($ship_id);
		$shippingLine = $shipMapper->getShippingLine($ship->getShippingLine());
		$trips = $shipMapper->getTrips($ship);
		$daysAtSea = 0;
		$ports = array();
		foreach ($trips as $trip){
			array_push($ports,$trip['FPC']);
			array_push($ports,$trip['TPC']);
			$date1 = new DateTime($trip['AD']);
			$date2 = new DateTime($trip['DD']);
			$daysAtSea += $date1->diff($date2)->days + 1;
		}
		$ports = array_unique($ports);
		?>
		
	<h1><?php echo $ship->getShipName(); ?> </h1>
	<table>
		<tr>
			<td><b>Shipping Line:</b></td>
			<td><?php echo $shippingLine['SN'];?> </td>
		</tr>
		<tr>
			<td><b>Shiptype:</b></td>
			<td><?php echo $ship->getType();?></td>
		</tr>
		<tr>
			<td><b>Days at sea:</b></td>
			<td><?php echo $daysAtSea ?></td>
		
		</tr>
		</table>
		<br>
		<h2>Trips</h2>
		<div class="hoverclass">
		<table>
			<tr>
				<th>From port</th>
				<th>To port</th>
				<th>Departure date</th>
				<th>Arrival date</th>
				<th>Nb of containers</th>
			</tr>
			<?php foreach($trips as $trip){
			?>
				<tr>
					<td><?php echo $portMapper->find($trip['FPC'])->getPortName(); ?></td>
					<td><?php echo $portMapper->find($trip['TPC'])->getPortName(); ?></td>
					<td><?php echo $trip['DD']; ?></td>
					<td><?php echo $trip['AD']; ?></td>
					<td><a href='containers.php?ship_id=
					<?php echo $ship->getShipId(); ?>&route_id=<?php echo $trip['RI']; ?>&departure_date=<?php echo $trip['DD'];?>'><?php echo $containerMapper->getNbOfContainers($ship->getShipId(),$trip['RI'],$trip['DD']) ;?></a></td>
				</tr>
			<?php } ?>
		</table>
		</div>
		<br>
		<br>
		<h1> Visited ports </h1>
		<div class = "hoverclass";>
			<table>
				<?php foreach($ports as $port){ ?>
				<tr>
					<td>
					<?php echo $portMapper->find($port)->getPortName(); ?>
					</td>
				</tr>
				<?php }?>
			</table>
		</div>

<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>