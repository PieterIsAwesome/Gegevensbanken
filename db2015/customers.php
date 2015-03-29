<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of customers";

	// Voer de inhoud van "top.tpl.php" uit. Deze verzorgt de
	// algemene pagina lay-out aan de bovenkant van de pagina en het menu.
	require("template/top.tpl.php");
	
	// Door gebruik te maken van CustomerMapper en de functie findAll
	// creëren we een variabele die alle customers omvat.
    require_once( "gb/mapper/CustomerMapper.php" );
    $mapper = new gb\mapper\CustomerMapper();//
    $allCustomer = $mapper->findAll();
?>
<div class='hoverclass'>
	<table>
            <tr>
                <th>Ssn</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>City</th>
            </tr>
<?php
	// We herbenoemen de variabele allCustomer naar customer en selecteren
	// telkens één element ervan. Voor elk element maken we een nieuwe
	// rij in de tabel met de bijbehorende eigenschappen van het element.
    foreach($allCustomer as $customer) {
 ?>
       <tr>
		<td><?php echo $customer->getSsn(); ?></td>
		<td><?php echo $customer->getFirstName(); ?></td>
		<td><?php echo $customer->getLastName(); ?></td>
                <td><?php echo $customer->getAddress(); ?></td>
                <td><?php echo $customer->getCity(); ?></td>
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