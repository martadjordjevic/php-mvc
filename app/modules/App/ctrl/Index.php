<?php

use Application\Controller\ControllerAbstract;
use App\models\Index as IndexMapper;

class Index extends ControllerAbstract {
    
    public function indexAction() {
        $this->_view->assign('test', '1234');
        echo $this->_view->fetch('index.tpl');
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

