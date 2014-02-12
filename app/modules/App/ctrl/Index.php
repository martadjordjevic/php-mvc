<?php

use Application\Controller\ControllerAbstract;
use App\models\Index as IndexMapper;

class Index extends ControllerAbstract {
    
    public function __construct() {
        parent::__construct();
//        $this->_appConfig = Application\Registry::get('config');
//        print_r($this->_appConfig->router->defaultRoute);
    }
    
    public function indexAction() {
        return array('tpl' => 'index.tpl', 'vars' => array(
            'test' => '1234',
            'param' => 'param 1',
            'arr' => array('0' => 'test 0', '1' => 'test 1')
        ));
    }
    
    public function testAction() {
        $indexMapper = new IndexMapper();
        $rows = $indexMapper->getDataFromDatabese();
        return array('vars' => array('test' => $rows));
    }
    
    public function demoAction() {
        
        return array("vars" => array(
            'test' => ''
        ));
    }
}

