<?php

namespace Application;


class Request {
    
    public function getParams() {
        return $_REQUEST;
    }
    
    public function getModule() {
        return (isset($_REQUEST['mod'])) ? $_REQUEST['mod'] : 'App';
    }
    
    public function getController() {
        return (isset($_REQUEST['ctrl'])) ? $_REQUEST['ctrl'] : 'Index';
    }
    
    public function getAction() {
        return (isset($_REQUEST['act'])) ? $_REQUEST['act'] : 'index';
    }
    
}

?>
