<?php

use Application\Controller\ControllerAbstract;
use App\models\Index as IndexMapper;

class Index extends ControllerAbstract {
    
    public function indexAction() {
//        die('Cao Marta');
        $mapper = new IndexMapper();
        var_dump($mapper->getDataForIdexAction());
    }
    
    public function mikiAction() {
        var_dump($this->_request->getParams());
        die('Cao Miki');
    }
}

