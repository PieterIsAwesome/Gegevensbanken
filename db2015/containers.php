<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of containers";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	require_once("gb/mapper/ContainerMapper.php");
	$ship_id = $_GET['ship_id'];
	$route_id = $_GET['route_id'];
	$departe_date = $_GET['departure_date'];
	if (!preg_match('/^[0-9]{4}\D[0-9]{2}\D[0-9]{2}$/',$departe_date)){
		header("Location:error.php");
	}
	$containerMapper = new gb\mapper\ContainerMapper();
	$containers = $containerMapper->getContainers($ship_id,$route_id,$departe_date);
?>
	<div class="hoverclass">
	<table>
		<tr>
			<th>ContainerID</th>
			<th>Shipping Line</th>
			<th>Length</th>
			<th>Height</th>
			<th>Width</th>
			<th>Weight</th>
			
		</tr>
		<?php foreach($containers as $container){ ?>
			<tr>
				<td>
					<?php echo $container->getContainerID(); ?>
				</td>
				<td>
					<?php echo $containerMapper->getShippingLineName($container); ?>
				</td>
				<td>
					<?php echo $container->getLength(); ?>
				</td>
				<td>
					<?php echo $container->getHeight(); ?>
				</td>
				<td>
					<?php echo $container->getWidth(); ?>
				</td>
				<td>
					<?php echo $container->getWeight(); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	</div>
<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>