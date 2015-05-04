<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Port.php" );


class PortMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM port where port_code = ?";
        $this->selectAllStmt = "SELECT * FROM port ";
        
    } 
   
    function getCollection( array $raw ) {
        
        $portCollection = array();
        foreach($raw as $row) {
            array_push($portCollection, $this->doCreateObject($row));
        }
        
        return $portCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Port( $array['port_code'] );
        $obj->setPortId($array['port_code']);
        $obj->setPortName($array['port_name']);

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