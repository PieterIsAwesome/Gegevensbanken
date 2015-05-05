<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php");



class ShipsShipLines extends PageController {
    function process() {
		
        if (isset($_POST["shippingLines"])) {
			$shipMapper = new \gb\mapper\ShipMapper();
            $allShips = $shipMapper->getShipsShippingLine($_POST['shippingLines']); 
			// Voor iedere customer in de stad maken we een rij aan.
			foreach($allShips as $ship){
				echo "<tr>
					<td>".$ship->getShipId(). "</td>
					<td>" .$ship->getShipName(). "</td>
					<td>".$ship->getType()."</td>
					</tr>";     
			}
			
        }
    }
}
?>