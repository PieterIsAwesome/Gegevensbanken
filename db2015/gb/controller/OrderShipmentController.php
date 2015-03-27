<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
require_once("gb/mapper/OrdersMapper.php");
use gb\mapper as mapper;

class OrderShipmentController extends PageController {
    private $customer;
    
    function process() {
        
        if (!$this->isSsnNull()) {
            $this->customer = $this->lookupCustomer($_POST["ssn"]);
			if (is_null($this->customer)){
				echo "<a href ='/db2015/create_customer.php'> Create a new customer </a>";
			}
        } 
 
        if (isset($_POST["order_shipment"])){
            $this->placeShipmentOrder();
        }
                
    }
    
    function isSsnNull() {
        return !(isset ($_POST['ssn']));
    }
    
    function isOrderShipmentDisabled() {
        return is_null($this->customer);
    }
    
    function isOrderShipmentEnabled() {
        return (isset($_POST["order_shipment"]));
    }
            
    function lookupCustomer ($ssn) {
        $this->customer = null;
        $mapper = new \gb\mapper\CustomerMapper();//
        return $mapper->find($ssn);
    }
    
    function getCustomerSsn() {
        if (!is_null($this->customer)) {
            return $this->customer->getSsn();
        } else {
            return '';
        }
    }
    
    function getCustomerFirstName() {
        if (!is_null($this->customer)) {
            return $this->customer->getFirstName();
        } else {
            return '';
        }
    }
    
    function getCustomerLastName() {
        if (!is_null($this->customer)) {
            return $this->customer->getLastName();
        } else {
            return '';
        }
    }
    
    function getCustomerCity() {
        if (!is_null($this->customer)) {
            return $this->customer->getCity();
        } else {
            return '';
        }
    }
    
    function getCustomerStreet() {
        if (!is_null($this->customer)) {
            return $this->customer->getStreet();
        } else {
            return '';
        }
    }
    
    function getCustomerNumber() {
        if (!is_null($this->customer)) {
            return $this->customer->getNumber();
        } else {
            return '';
        }
    }
    
    function getCustomerBus() {
        if (!is_null($this->customer)) {
            return $this->customer->getBus();
        } else {
            return '';
        }
    }
    
    function getCustomerPostalCode () {
        if (!is_null($this->customer)) {
            return $this->customer->getPostalCode();
        } else {
            return '';
        }
    }
    
    function placeShipmentOrder() {
        $stmt = "insert into orders values (?,?,?,?,?)";
		$stmt2 = "insert into shipment values (?,?,?)";
		$shipment_id = $_POST['shipment_id'];
		$volume = $_POST['volume'];
		$weight = $_POST['weight'];
		$price = $_POST['price'];
		$date = $_POST['date'];
		$ssn = $_POST['ssn'];
		$ship_broker = $_POST['ship_broker'];
		
		$mapper = new mapper\OrdersMapper();
		$con = $mapper->getConnectionManager();
		$con->executeInsertStatement($stmt,array($shipment_id,$ssn,$ship_broker,$price,$date));
		$con->executeInsertStatement($stmt2,array($shipment_id,$volume,$weight));
    }
}

?>