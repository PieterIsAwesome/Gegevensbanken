<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();//
	$shipbrokerrevenue = $mapper -> getShipBrokerRevenues();
 ?>
 <div class = hoverclass>
<table>
    <tr>
        <td>Ship broker name</td>
        <td>From port</td>
        <td>To port</td>
        <td>Revenue</td>
        <td>Date (mm/yyyy)</td>
    </tr>
	<?php foreach($shipbrokerrevenue as $revenue){
		?>
		<tr>
		<td><?php echo $revenue['ship_broker_name']; ?></td>
		<td><?php echo $revenue['from_port_code']; ?></td>
        <td><?php echo $revenue['to_port_code']; ?></td>
		<td><?php echo $revenue['price_sum']; ?></td>
		<td><?php 
		$month = 1 + (date('m')-2)%12;
		$month = sprintf("%02d", $month);
		$year = date('Y');
		echo  $month. "/" .$year ;
        ?> </td>        
	</tr>     
	<?php }?>
	
</table>
</div>
<?php
	require("template/bottom.tpl.php");
?>