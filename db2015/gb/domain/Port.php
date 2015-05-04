<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Port extends DomainObject {    
      
    private $portId;
    private $portName;
   

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
        
    function setPortId ( $portId ) {
        $this->portId = $portId;        
    }
    
    function getPortId () {
        return $this->portId;
    }
    
    function setPortName ($portName) {
        $this->portName = $portName;
    }
    
    function getPortName() {
        return $this->portName;
    }

}

?>
