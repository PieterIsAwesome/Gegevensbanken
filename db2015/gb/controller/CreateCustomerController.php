<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
use gb/mapper as Mapper
class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
			$array = array("ssn" =>$_POST["ssn"],'first_name'=>$_POST["first_name"],'last_name' =>$_POST['last_name'],"number"=>$_POST["number"])
			if ($_POST["bus"] = ""){}
            $custMapper = new Mapper/CustomerMapper();
        }
    }
}

?>