<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Container.php" );


class ContainerMapper extends Mapper {
	function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIP where ship_id = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP ";
        
    } 
	function getContainers($ship_id,$route_id,$departure_date){
		$stmt = "SELECT Distinct C.container_id,C.Shipping_line_code,C.lenght,C.height,C.width,C.weight FROM Container as C, ships as S WHERE C.container_id = 
		S.container_id AND C.shipping_line_code = S.shipping_line_code AND S.ship_id = ? AND S.Route_id = ? AND S.Departure_date = "."'".$departure_date."'";
		$result = self::$con->executeSelectStatement($stmt,array($ship_id,$route_id));

		return $this->getCollection($result);
	}
	function getNbOfContainers($ship_id,$route_id,$departure_date){
		
		$stmt = "SELECT COUNT(Distinct container_id) AS count FROM ships WHERE ship_id = ? AND route_id = ? AND Departure_date="."'".$departure_date."'";
		$result = self::$con->executeSelectStatement($stmt,array($ship_id,$route_id));
		return $result[0]['count'];
	}
	 function getCollection( array $raw ) {
        
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
        
        return $shipCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Container( $array['container_id'] );
        
        $obj->setContainerId($array['container_id']);
        $obj->setShippingLineCode($array['Shipping_line_code']);
        $obj->setLength($array['lenght']);
        $obj->setWidth($array['width']);
		$obj->setHeight($array['height']);
		$obj->setWeight($array['weight']);
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
	function getShippingLineName($container){
		$stmt = "SELECT shipping_line_name FROM shipping_line WHERE shipping_line_code = ?";
		return self::$con->executeSelectStatement($stmt,array($container->getShippingLineCode()))[0]['shipping_line_name'];
		
	}
}
?>