<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/domain/Shipment.php");
require_once("gb/domain/Orders.php");
require_once("gb/mapper/ShipmentMapper.php");
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
		// Voorbereiden van het insert statement voor de gegevens die in de tabel orders geplaatst moeten worden. 
        $stmt = "insert into orders values (?,?,?,?,?)";
		// Voorbereiden van het insert statement voor de gegevens die in de tabel shipment geplaatst moeten worden.
		$stmt2 = "insert into shipment values (?,?,?)";
		// Opslaan van de door de gebruiker ingegeven gegevens.
		$shipment = new \gb\domain\Shipment($_POST['shipment_id']);
		$shipment->setShipmId($_POST['shipment_id']);
		$shipment->setVolume($_POST['volume']);
		$shipment->setWeight($_POST['weight']);
		$order = new \gb\domain\Orders($_POST['shipment_id']);
		$order->setShipmId($_POST['shipment_id']);
		$order->setCustomerSsn($_POST['ssn']);
		$order->setShipBrokerName($_POST['ship_broker']);
		$order->setPrice($_POST['price']);
		$order->setOrderDate($_POST['date']);
		// controleren of de datum voldoet aan het opgestelde patroon voor de datum in SQL
		if(preg_match('/^[0-9]{4}\D[0-9]{2}\D[0-9]{2}$/', $_POST['date'])){ 
			$shipmentMapper = new \gb\mapper\ShipmentMapper();
			$shipmentMapper->insert($shipment);
			$orderMapper = new \gb\mapper\OrdersMapper();
			$orderMapper->insert($order);
		}	
		else{
			echo "Make sure the date matches the yyyy/mm/dd ";
		}
	}
}
?>