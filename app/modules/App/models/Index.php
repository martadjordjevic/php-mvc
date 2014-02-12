<?php

namespace App\models;

use Application\Database\Database;

class Index {
    
    public function getDataForIdexAction() {
        return array('name' => 'Marta', 'appName' => 'Hello World App');
    }
    
    public function getDataFromDatabese() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM test;";
        return $db->getRows($sql);
    }
    
}
