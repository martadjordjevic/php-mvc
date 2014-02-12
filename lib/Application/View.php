<?php

namespace Application;

use Rain\Tpl;
use Application\Request;

class View {
    
    private $tEngine;
    
    private $_templateEngine = 'smarty';
    
    private $_request;
    
    private static $instance;
    
    public static function getInstance() {
        if(!self::$instance) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
    
    public function __construct() {
        $this->_request = new Request();
        $this->initViewComponent();
    }
        
    private function initViewComponent() {
        if($this->_templateEngine == 'smarty') {
            $smarty = new \Smarty();
            $smarty->setTemplateDir(BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."modules/".$this->_request->getModule()."/view/".strtolower($this->_request->getController()).'/');
            $this->tEngine = $smarty;
        }
        else {
            $config = array(
                "tpl_dir"       => BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."modules/".$this->_request->getModule()."/view/".strtolower($this->_request->getController()),
                "cache_dir"     => BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."tplCache"
            );
            Tpl::configure($config);
            $this->tEngine = new Tpl();
        }
    }
    
    public function setContent($content) {
        $this->tEngine->assign('content', $content);
        echo $this->tEngine->fetch('../layout.tpl');        
    }
    
    public function renderView($params) {
        if(!is_array($params))
        {
            throw new \Exception('controller must return array');
        }
        else {
            $template = isset($params['tpl']) ? $params['tpl'] : $this->_request->getAction().'.tpl';
            if(isset($params['vars'])) {
                foreach($params['vars'] as $key => $value) {
                    $this->tEngine->assign($key, $value);
                }
            }
            return $this->tEngine->fetch($template);
        }
    }
    
}

