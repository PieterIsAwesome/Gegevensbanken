<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Container extends DomainObject {    
      
    private $container_id;
    private $shipping_line_code;
    private $length;   
	private $height;
	private $width;
	private $weight;
    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
        
    function setContainerId ( $container_id ) {
        $this->container_id = $container_id;        
    }
    
    function getContainerId () {
        return $this->container_id;
    }
    
    function setShippingLineCode ($shipping_line_code) {
        $this->shipping_line_code = $shipping_line_code;
    }
    
    function getShippingLineCode() {
        return $this->shipping_line_code;
    }
    
    function setLength ($length) {
        $this->length = $length;
    }
    
    function getLength () {
        return $this->length;
    }
	function setWidth ($width) {
        $this->width = $width;
    }
    
    function getWidth () {
        return $this->width;
    }
	function setHeight ($height) {
        $this->height = $height;
    }
    
    function getHeight () {
        return $this->height;
    }
	function getWeight(){
		return $this->weight;
	}
	function setWeight(){
		return $this->weight;
	}
}

?>
