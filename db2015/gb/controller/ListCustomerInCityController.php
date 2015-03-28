<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php");
use gb\mapper as CustMap;


class ListCustomerInCityController extends PageController {
    function process() {
        if (isset($_POST["city"])) {
			// Het aanmaken van een nieuwe customer mapper
			$custMapper = new CustMap\CustomerMapper();
			// We maken met een array met aan met alle customers in de door de gebruiker gevraagde stad.
            $allCustInCity = $custMapper->getCustomersInCity($_POST["city"]); 
			// Voor iedere customer in de stad maken we een rij aan.
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