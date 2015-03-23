<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of customers";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

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
	require("template/bottom.tpl.php");
?>