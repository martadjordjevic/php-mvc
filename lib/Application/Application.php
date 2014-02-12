<?php

namespace Application;

use Application\Router;
use Application\Registry;

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
            $this->_config = new Config(require BASE_DIR.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
            $registry = Registry::getInstance();
            $registry->set('config', $this->_config);
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
    
    public function _getEnvironment() {
        return getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
    }
    
}

