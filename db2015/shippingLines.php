<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of customers";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	
	// Door gebruik te maken van CustomerMapper en de functie findAll
	// creëren we een variabele die alle customers omvat.
    require_once( "gb/mapper/ShippingLineMapper.php" );
    $mapper = new gb\mapper\ShippingLineMapper();//
    $allshippingLines  = $mapper->findAll();
?>


<form method="post">    

<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">Shipping Line:</td>
        <td style="width: 40%">
            <select style="width: 100%" name="shippingLines">
			 
				<?php // Maak een dropdown menu met de verschillende steden
				foreach($allshippingLines as $shippingLine){
                echo "<option value="."'".$shippingLine->getShippingLineCode() ."'" .">".$shippingLine->getShippingLineName() ."</option>" ;}
                ?>
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="Shipping_line" name="SummitShippinglines"></td>
        <td style="width: 30%"></td>
    </tr>
</table>  
<div class = "hoverclass">
<table>
	<tr>
		<th> Ship ID</th>
		<th> Ship Name</th>
		<th> Ship Type</th>
	</tr>
<?php
require_once( "gb/controller/ShipsShipLines.php" );
    $filterController = new gb\controller\ShipsShipLines();
    $filterController->process();

?>
</table>
</div>
<?php
	// Voer de inhoud van "bottom.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de onderkant van de pagina.
	require("template/bottom.tpl.php");
?>