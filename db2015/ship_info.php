<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of ships";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	require_once("gb/mapper/ShipMapper.php")
	
?>
<?php 	$shipMapper = new gb\mapper\ShipMapper();
		$ship_id = $_GET['ship_id']; 
		$ship = $shipMapper->find($ship_id);
		?>
	<h1><?php echo $ship->getShipName() ?> </h1>

<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>