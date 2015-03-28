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
		// Berekenen van de vorige maand
        $month = 1 + (date('m')-2)%12;
		// Omzetten van de maand in de vorm XX
		$month = sprintf("%02d", $month);
		// Het berekenen van jaar.
		if (date('m') == 1 ){
			$year = date('Y')-1 ;
			}
		else{
			$year = date('Y');
		}
		// Opvragen van de connectie manager
        $con = $this->getConnectionManager();
		// Het voorbereiden van het select stament
        $selectStmt = "SELECT orders.ship_broker_name,sum(orders.price) as price_sum , f.port_name as from_port_code , t.port_name as to_port_code FROM orders,ships,route,port as f,port as t 
		WHERE orders.shipment_id = ships.shipment_id and ships.route_id = route.route_id and f.port_code = route.from_port_code and t.port_code = route.to_port_code and orders.order_date LIKE"."'".$year."-".$month."-"."__' 
		group by orders.ship_broker_name,route.from_port_code,route.to_port_code";
		// Het uitvoeren van het select statement.
        $results = $con->executeSelectStatement($selectStmt, array());        
		// Geef het resultaat terug
        return $results;
        
        
    }
}


?>
