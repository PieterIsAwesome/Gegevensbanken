<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );


class ShipBrokerMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP_BROKER ";       
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBroker( $array['name'] );
        
        $obj->setName($array['name']);
        $obj->setNumber($array['number']);
        $obj->setStreet($array['street']);
        $obj->setBus($array['bus']);
        $obj->setPostalCode($array['postal_code']);
        $obj->setCity($array['city']);
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
    function update( \gb\domain\DomainObject $object ) {
       
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
    function getShipBrokerRevenues() {
        $month = 1 + (date('m')-2)%12;
		$month = sprintf("%02d", $month);
		$year = date('Y');
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT orders.ship_broker_name,sum(orders.price) as price_sum , route.from_port_code , route.to_port_code FROM orders,ships,route 
		WHERE orders.shipment_id = ships.shipment_id and ships.route_id = route.route_id and orders.order_date LIKE"."'".$year."-".$month."-"."__' 
		group by orders.ship_broker_name,route.from_port_code,route.to_port_code";
        $results = $con->executeSelectStatement($selectStmt, array());        
        return $results;
        
        
    }
}


?>
