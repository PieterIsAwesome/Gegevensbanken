<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php");
use gb\mapper as CustMap;


class ListCustomerInCityController extends PageController {
    function process() {
        if (isset($_POST["city"])) {
			$custMapper = new CustMap\CustomerMapper();
            $allCustInCity = $custMapper->getCustomersInCity($_POST["city"]); 
			foreach($allCustInCity as $customer){
				echo "<tr>
					<td>".$customer->getSsn(). "</td>
					<td>" .$customer->getFirstName(). "</td>
					<td>".$customer->getLastName()."</td>
					<td>". $customer->getAddress(). "</td>
					<td>". $customer->getCity()."</td>
					</tr>";     
			}
			
        }
    }
}
?>