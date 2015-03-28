<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );
require_once( "gb/mapper/Mapper.php" );
use gb\mapper as mapper;



class UpdateShipController extends PageController {
        
    function process() {
        if (isset($_POST["update_ship"])) {
			// Aanmaken van een nieuwe ship mapper
			$mapper = new \gb\mapper\ShipMapper();
			// Het voorbereiden van het update statement.
			$stmt =" Update ship set ship_name = ?, type = ? where ship_id = ?";
			// Het opslaan van de gegevens door de gebruiker meegegeven.
			$ship_id = $_POST['ship_id'];
			$ship_name = $_POST['ship_name'];
			$ship_type = $_POST['ship_type'];
			// Het opvragen van de connectie.
			$con =$mapper->getConnectionManager();
			// Het uitvoeren van het update statement.
			$con->executeUpdateStatement($stmt, array($ship_name,$ship_type,$ship_id));        
			
			//$ship = $mapper->find("ship_id");
			//$ship -> setType("ship_type");
			//$ship -> setShipName("ship_name");
        }
    }
}

?>