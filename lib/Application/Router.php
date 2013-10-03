<?php

namespace Application;

use Application\Request;

class Router {
    
    private $_request;
    private $_ctrlInstance;
    private $_action;
    
    public function __construct() {
        $this->_request = new Request();
    }
    
    public function dispatch() {
      
        try {
            $this->_loadCtrl();
            $ctrlName = ucfirst(strtolower($this->_request->getController()));
            $this->_action = strtolower($this->_request->getAction()).'Action';
            $act = $this->_request->getAction().'Action';
            $this->_ctrlInstance = new $ctrlName();
            $instance = $this->_ctrlInstance;
            if($this->_methodExists()) {
                $instance->$act();
            }
        }
        catch(Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }
    
    private function _loadCtrl() {
        $ctrlPath = APPLICATION_PATH.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->_request->getModule().DIRECTORY_SEPARATOR.'ctrl'.DIRECTORY_SEPARATOR.$this->_request->getController().'.php';
        if(file_exists(realpath($ctrlPath))) {
            require $ctrlPath;
            return true;
        }
        else {
            throw new Exception('Controller does not exists', '404', '');
        }
    }
    
    private function _methodExists() {
        if(method_exists($this->_ctrlInstance, $this->_action)) {
            return true;
        }
        else {
            throw new Exception('Action does not exists in'.$this->_request->getController(), '404', '');
        }
    }
    
}
