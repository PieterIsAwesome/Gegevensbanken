<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Shipping database";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");

	
echo "Welcome to the shipping web application!<br /><br />";
echo "Today is " . date("dS F Y"); echo "<br />";

?>
<!-- Het invoegen van een mooie image -->
<img src="http://www.blastr.com/sites/blastr/files/mlp.jpg" width="300px" height="200px">
<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>