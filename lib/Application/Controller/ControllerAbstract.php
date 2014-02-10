<?php

namespace Application\Controller;

use Application\Request;
use Rain\Tpl;
use Application\View;

abstract class ControllerAbstract {
    
    protected $_request;
    protected $_view;
    
    protected $_templateEngine = 'smarty';
    
    function __construct() {
        $this->_request = new Request();
//        $this->__initView();
        print_r($this->_request->getModule().' '.$this->_request->getController().' '.$this->_request->getAction());
    }
    
    private function __initView() {
        if($this->_templateEngine == 'smarty') {
            $smarty = new \Smarty();
            $smarty->setTemplateDir(BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."modules/".$this->_request->getModule()."/view/".strtolower($this->_request->getController()).'/');
            $this->_view = $smarty;
        }
        else {
            $config = array(
                "tpl_dir"       => BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."modules/".$this->_request->getModule()."/view/".strtolower($this->_request->getController()),
                "cache_dir"     => BASE_DIR.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR."tplCache"
            );
            Tpl::configure($config);
            $this->_view = new Tpl();
        }
    }
    
}
