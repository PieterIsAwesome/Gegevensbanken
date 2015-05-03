<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Orders extends DomainObject {    
      
    private $shipment_id;
    private $customer_ssn;
    private $ship_broker_name;
    private $price;
    private $order_date;


    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
    function setShipmId( $shipment_id ) {
        $this->shipment_id = $shipment_id;        
    }

    function getShipmId( ) {
        return $this->shipment_id;
    }
    
    function setCustomerSsn ( $customer_ssn ) {
        $this->customer_ssn = $customer_ssn;        
    }
    
    function getCustomerSsn () {
        return $this->customer_ssn;
    }
    
    function setShipBrokerName ($ship_broker_name ) {
        $this->ship_broker_name = $ship_broker_name;
    }
    
    function getShipBrokerName () {
        return $this->ship_broker_name;
    }
    
    function setPrice ($price) {
        $this->price = $price;
    }
    
    function getPrice () {
        return $this->price;
    }
       
    function setOrderDate ($order_date) {
        $this->order_date = $order_date;
    }
    function getOrderDate() {
        return $this->order_date;
    }
    function getArray(){
		return array($this->getShipmId( ),$this->getCustomerSsn (),$this->getShipBrokerName (),$this->getPrice (),$this->getOrderDate());
	}
}

?>
