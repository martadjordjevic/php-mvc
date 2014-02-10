<?php

use Application\Controller\ControllerAbstract;
use App\models\Index as IndexMapper;

class Index extends ControllerAbstract {
    
    public function indexAction() {
        return array('tpl' => 'index.tpl', 'vars' => array(
            'test' => '1234',
            'param' => 'param 1'
        ));
    }
    
    public function mikiAction() {
        var_dump($this->_request->getParams());
        die('Cao Miki');
    }
}

