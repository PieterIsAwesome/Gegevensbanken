<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );
$mapper = new gb\mapper\ShipMapper();//


class UpdateShipController extends PageController {
        
    function process() {
        if (isset($_POST["update_ship"])) {
			$ship = $mapper->find("ship_id");
        }
    }
}

?>