<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Shipping database";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");


echo "Welcome to the shipping web application!<br /><br />";
echo "Today is " . date("dS F Y"); echo "<br />";

?>
<img src="http://www.blastr.com/sites/blastr/files/mlp.jpg" width="300px" height="200px">
<?php
	require("template/bottom.tpl.php");
?>