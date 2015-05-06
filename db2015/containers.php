<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	require_once("gb/mapper/ContainerMapper.php");
	$ship_id = $_GET['ship_id'];
	$route_id = $_GET['route_id'];
	$departe_date = $_GET['departure_date'];
	$containerMapper = new gb\mapper\ContainerMapper();
	$containers = $containerMapper->getContainers($ship_id,$route_id,$departe_date);
?>
	<table>
		<?php foreach($containers as $container){ ?>
			<tr>
				<td>
				<?php echo $container->getContainerID(); ?>
				</td>
				<td>
				<?php echo $container->getLength(); ?>
				</td>
				<td>
				<?php echo $container->getWidth(); ?>
				</td>
				<td>
				<?php echo $container->getHeight(); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>