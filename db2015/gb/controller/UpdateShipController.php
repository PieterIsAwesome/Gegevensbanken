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
			
			// Het opslaan van de gegevens door de gebruiker meegegeven.
			$ship_id = $_POST['ship_id'];
			$ship_name = $_POST['ship_name'];
			$ship_type = $_POST['ship_type'];
			       
			$ship = $mapper->find($ship_id);
			$ship -> setType($ship_type);
			$ship -> setShipName($ship_name);
			$mapper->update($ship);
			header("Location:update_ship.php?ship_id=".$ship->getShipId()."&type=".$ship->getType()."&name=".$ship->getShipName());
			
        }
    }
}

?>