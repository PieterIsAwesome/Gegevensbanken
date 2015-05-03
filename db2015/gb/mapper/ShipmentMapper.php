<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Shipment.php" );


class ShipmentMapper extends Mapper {
	
	function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM SHIPMENT where shipment_id = ?";
        $this->selectAllStmt = "SELECT * FROM SHIPMENT ";    
		// Voorbereiden van het insert statement voor de gegevens die in de tabel shipment geplaatst moeten worden.
		$this->insertStmt = "INSERT INTO shipment VALUES(?,?,?)";		
    } 
	
	function getCollection( array $raw ) {
        
        $shipmentCollection = array();
        foreach($raw as $row) {
            array_push($shipmentCollection, $this->doCreateObject($row));
        }
        
        return $shipmentCollection;
    }
	
	protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Shipment( $array['shipment_id'] );

            $obj->setShipmId($array['shipment_id']);
            $obj->setVolume($array["volume"]);
            $obj->setWeight($array['weight']);
        } 
        return $obj;
    }
	
	protected function doInsert( \gb\domain\DomainObject $object ) {
		self::$con->executeInsertStatement($this->insertStmt,$object->getArray());
        /*$values = array( $object->getName() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );*/
    }
    
    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() ); 
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
}
?>