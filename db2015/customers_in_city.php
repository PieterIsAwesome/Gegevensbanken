<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customers in city";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    
	require_once("gb/mapper/cityMapper.php");
	$cityMapper = new gb\mapper\cityMapper();
	$allCities = $cityMapper->getAllCities();
?>

<form method="post">
    

<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">City</td>
        <td style="width: 40%">
            <select style="width: 100%" name="city">
				<?php foreach($allCities as $city){
                echo "<option value="."'".$city ."'" .">".$city ."</option>" ;}
                ?>
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="List customers in the city" name="list_customer"></td>
        <td style="width: 30%"></td>
    </tr>
</table>  
<div class = "hoverclass" > 
	<table>
            <tr>
                <th>Ssn</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>City</th>
            </tr>
			
<?php
require_once( "gb/controller/ListCustomerInCityController.php" );
    $filterController = new gb\controller\ListCustomerInCityController();
    $filterController->process();
?>
<?php
    require_once( "gb/mapper/CustomerMapper.php" );    
    $custMapper = new gb\mapper\CustomerMapper();//
 ?>
      
	

</table>
</div>    
</form> 
   
<?php
	require("template/bottom.tpl.php");
?>