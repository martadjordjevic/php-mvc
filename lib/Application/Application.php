<?php

namespace Application;

use Application\Config;
use Application\Router;

class Application {
    
    private $_config = null;
    
    private $_router;
    
    public function __construct() {
        
    }
    
    public function run() {
        $this->getConfig();
        $this->initRouter();
    }
    
    public function getConfig() {
        if($this->_config == null) {
            $config = new Config(APPLICATION_PATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'application.ini');
            $this->_config = $config->getConfig();
            return $this->_config;
        }
        else {
            return $this->_config;
        }
    }
    
    private function initRouter() {
        $this->_router = new Router();
        $this->_router->dispatch();
    }
    
}

