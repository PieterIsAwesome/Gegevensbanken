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
		// Voorbereiden van het insert statement voor de gegevens die in de tabel orders geplaatst moeten worden. 
        $stmt = "insert into orders values (?,?,?,?,?)";
		// Voorbereiden van het insert statement voor de gegevens die in de tabel shipment geplaatst moeten worden.
		$stmt2 = "insert into shipment values (?,?,?)";
		// Opslaan van de door de gebruiker ingegeven gegevens.
		$shipment_id = $_POST['shipment_id'];
		$volume = $_POST['volume'];
		$weight = $_POST['weight'];
		$price = $_POST['price'];
		$date = $_POST['date'];
		$ssn = $_POST['ssn'];
		$ship_broker = $_POST['ship_broker'];
		// controleren of de datum voldoet aan het opgestelde patroon voor de datum in SQL
		if(preg_match('/^[0-9]{4}/[0-9]{2}/[0-9]{2}$/', $date)){ 
			// Het aanmaken van een nieuwe orders mapper.
			$mapper = new mapper\OrdersMapper();
			// Het opvragen van de connection.
			$con = $mapper->getConnectionManager();
			// Uitvoeren van de insert statements met de nodige gegevens.
			$con->executeInsertStatement($stmt,array($shipment_id,$ssn,$ship_broker,$price,$date));
			$con->executeInsertStatement($stmt2,array($shipment_id,$volume,$weight));
    }	else{
		echo "Make sure the date matches the yyyy/mm/dd ";
	}
}

?>