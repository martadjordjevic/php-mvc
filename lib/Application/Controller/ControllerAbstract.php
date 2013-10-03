<?php

namespace Application\Controller;

use Application\Request;

abstract class ControllerAbstract {
    
    protected $_request;
    
    function __construct() {
        $this->_request = new Request();
    }    
    
}
