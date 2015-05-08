<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Ship.php" );


class ShipMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIP where ship_id = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP ";
        
    } 
    
    function getCollection( array $raw ) {
        
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
        
        return $shipCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Ship( $array['ship_id'] );
        
        $obj->setShipId($array['ship_id']);
        $obj->setShipName($array['ship_name']);
        $obj->setType($array['type']);
        $obj->setShippingLine($array['owner_id']);
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
    function update( \gb\domain\DomainObject $object ) {
		// Het voorbereiden van het update statement.
			$stmt =" Update ship set ship_name = ?, type = ? where ship_id = ?";
			self::$con-> executeUpdateStatement($stmt, array($object->getShipName(),$object->getType(),$object->getShipId()));
			
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
    function getShippingLine($id){
		$stmt = "SELECT shipping_line_name AS SN FROM shipping_line WHERE shipping_line_code= ?";
		$array = array($id);
		$rows = self::$con->executeSelectStatement($stmt,$array);
		foreach($rows as $row) {
            $result = $row;
        }
        return $result; 
		
	}
	function getTrips($ship){
		// Geeft de trips die een bepaald schip heeft gedaan weer
		$stmt = "SELECT R.from_port_code AS FPC,R.to_port_code AS TPC,T.departure_date AS DD,T.arrival_date as AD ,T.Route_id AS RI FROM Trip AS T,Route As R WHERE T.ship_id = ? AND T.Route_id =R.Route_id";
		$result = self::$con->executeSelectStatement($stmt,array($ship->getShipId()));
		return $result;
	}
	function getShipsShippingLine($shiplineid){
		// Geeft de schepen van een bepaalde shipping line weer
		$stmt = "SELECT * FROM ship WHERE owner_id = ? ";
		$result = self::$con->executeSelectStatement($stmt,array($shiplineid));
		
		
		return $this->getCollection($result);
	}
}


?>
