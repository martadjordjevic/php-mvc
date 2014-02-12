<?php
/**
 * Registry class
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

namespace Application;

class Registry extends \ArrayObject {
    
    /**
     * Singleton instance
     * @var type (object)
     */
    private static $instance;
    
    public static function getInstance() {
        if(!self::$instance) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
    
    
    /**
     * Set data to registry
     * @param type $index
     * @param type $data
     */
    public static function set($index, $data) {
        $instance = self::getInstance();
        $instance->offsetSet($index, $data);
    }
    
    /**
     * Get saved data from registry
     * @param type $index
     * @return type
     * @throws Exception
     */
    public static function get($index) {
        $instance = self::getInstance();
        if(!$instance->offsetExists($index)) {
            throw new Exception('Index don\'t exists in registry');
        }
        else {
            return $instance->offsetGet($index);
        }
    }
    
    /**
     * Check if some key is stored in registry
     * @param type $index
     * @return boolean
     */
    public static function isRegistred($index) {
        if(!self::$instance) {
            return false;
        }
        return self::$instance->offsetExists($index);
    }
    
    /**
     * Check if key is stored in registry
     * @param type $index
     * @return type
     */
    public function offsetExists($index) {
        return array_key_exists($index, $this);
    }
    
}