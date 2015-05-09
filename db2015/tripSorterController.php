
	<?php if (isset($_GET['sort_on']) && in_array($_GET['sort_on'],array('FPC','TPC','AD','DD'))){
		$trips = $shipMapper->getTripsSortOn($ship,$_GET['sort_on']);
	foreach($trips as $trip){
			?>
				<tr>
					<td><?php echo $portMapper->find($trip['FPC'])->getPortName(); ?></td>
					<td><?php echo $portMapper->find($trip['TPC'])->getPortName(); ?></td>
					<td><?php echo $trip['DD']; ?></td>
					<td><?php echo $trip['AD']; ?></td>
					<td><a href='containers.php?ship_id=
					<?php echo $ship->getShipId(); ?>&route_id=<?php echo $trip['RI']; ?>&departure_date=<?php echo $trip['DD'];?>'><?php echo $containerMapper->getNbOfContainers($ship->getShipId(),$trip['RI'],$trip['DD']) ;?></a></td>
				</tr>
	<?php } }?>


