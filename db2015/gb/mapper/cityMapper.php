<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );



class CityMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT Distinct City FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT Distinct Cit FROM CUSTOMER where city <> '' ";        
    } 
    
    function getCollection( array $raw ) {
        
        $cityCollection = array();
        foreach($raw as $row) {
            array_push($cityCollection, $row["city"]);
        }
        asort($cityCollection);
        return $cityCollection;
    }

  protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Customer( $array['city'] );

            
        } 
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        /*$values = array( $object->getName() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );*/
    }
    
    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() ); 
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
	function getAllCities(){
		$con = $this->getConnectionManager();
		$selectStmt = "SELECT Distinct city FROM CUSTOMER where city<>''";
		$cities= $con->executeSelectStatement($selectStmt,array()); 
		
		return $this->getCollection($cities);
		}
	}
 ?>   