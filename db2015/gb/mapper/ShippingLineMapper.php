<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShippingLine.php" );


class ShippingLineMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM shipping_line where shipping_line_code= ?";
        $this->selectAllStmt = "SELECT * FROM shipping_line ";
        
    } 
    
    function getCollection( array $raw ) {
        
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
        
        return $shipCollection;
    }

    protected function doCreateObject( array $array ) {
		
        $obj = new \gb\domain\ShippingLine( $array['shipping_line_code'] );
        
        $obj->setShippingLineCode ($array['shipping_line_code']);
        $obj->setShippingLineName($array['shipping_line_name']);
        $obj->setCountryId ($array['country_id']);
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
    function update( \gb\domain\DomainObject $object ) {
		
			
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
}


?>