<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/ShipBrokerMapper.php" );
	// Het aanmaken van een nieuwe ship broker mapper.
    $mapper = new gb\mapper\ShipBrokerMapper();
	// op roepen van de revenues van alle shipbrokers afgelopen maand.
	$shipbrokerrevenue = $mapper -> getShipBrokerRevenues();
 ?>
 <div class = hoverclass>
<table>
    <tr>
        <th>Ship broker name</th>
        <th>From port</th>
        <th>To port</th>
        <th>Revenue</th>
        <th>Date (mm/yyyy)</th>
    </tr>
	
	<?php // Print alle shipbroker revenues af.
	foreach($shipbrokerrevenue as $revenue){
		?>
		<tr>
		<td><?php echo $revenue['ship_broker_name']; ?></td>
		<td><?php echo $revenue['from_port_code']; ?></td>
        <td><?php echo $revenue['to_port_code']; ?></td>
		<td><?php echo $revenue['price_sum']; ?></td>
		<td><?php 
		$month = 1 + (date('m')-2)%12;
		$month = sprintf("%02d", $month);
		if (date('m') == 1 ){
			$year = date('Y')-1 ;
			}
		else{
			$year = date('Y');
		}
		echo  $month. "/" .$year ;
        ?> </td>        
	</tr>     
	<?php }?>
	
</table>
</div>
<?php
	require("template/bottom.tpl.php");
?>