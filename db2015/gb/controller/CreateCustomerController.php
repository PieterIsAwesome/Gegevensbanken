<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
use gb\mapper as Mapper;
class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
			// We constueren een een array met de ssn, first_name , last_name ,street,number,bus,postal_code,city en mobile phone nummer
			// Deze gegevens zijn door de gebruiker ingegeven
			$array = array($_POST["ssn"],$_POST["first_name"],$_POST['last_name'],$_POST["street"],$_POST["number"],$_POST["bus"],$_POST["postal_code"],$_POST["city"],$_POST["mobiphone"]);
			// We maken een nieuwe CustomerMapper aan.
            $custMapper = new Mapper\CustomerMapper();
			// We bereiden het insert statement dat straks zal worden meegegeven.
			$insertStmt = "INSERT INTO CUSTOMER VALUES (?,?,?,?,?,?,?,?,?)";
			// Vragen de connectie met de SQL- database op.
			$con = $custMapper -> getConnectionManager();
			// We voeren het insertstatement uit op de database.
			$con->executeInsertStatement($insertStmt,$array);
			// We geven aan dat de insert succesvol is verlopen.
			echo "The new customer was correctly inserted."
        }
    }
}

?>