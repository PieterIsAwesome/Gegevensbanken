<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
use gb\mapper as Mapper;
class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
			$array = array($_POST["ssn"],$_POST["first_name"],$_POST['last_name'],$_POST["street"],$_POST["number"],$_POST["bus"],$_POST["postal_code"],$_POST["city"],$_POST["mobiphone"]);
            $custMapper = new Mapper\CustomerMapper();
			$insertStmt = "INSERT INTO CUSTOMER VALUES (?,?,?,?,?,?,?,?,?)";
			$con = $custMapper -> getConnectionManager();
			$con->executeInsertStatement($insertStmt,$array);
        }
    }
}

?>