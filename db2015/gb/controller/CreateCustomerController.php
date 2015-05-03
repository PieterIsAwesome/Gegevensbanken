<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
require_once( "gb/domain/Customer.php" );
use gb\mapper as Mapper;
class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
			// We construeren een een array met de ssn, first_name , last_name ,street,number,bus,postal_code,city en mobile phone nummer
			// Deze gegevens zijn door de gebruiker ingegeven
			// We maken een nieuwe CustomerMapper aan.
            $custMapper = new Mapper\CustomerMapper();
			$obj= new \gb\domain\Customer( $_POST['ssn'] );
			$obj->setSsn($_POST["ssn"]);
            $obj->setNumber($_POST["number"]);
            $obj->setFirstName($_POST["first_name"]);
            $obj->setLastName($_POST['last_name']);
            $obj->setStreet($_POST["street"]);
            $obj->setBus($_POST["bus"]);
            $obj->setPostalCode($_POST["postal_code"]);
            $obj->setCity($_POST["city"]);
			$obj->setMobi($_POST["mobiphone"]);
			try{
				$custMapper->insert($obj);}
			catch(PDOException $e){
				echo "Sorry an error occured.";
			}
			
			// We geven aan dat de insert succesvol is verlopen.
			echo "The new customer was correctly inserted.";
        }
    }
}

?>