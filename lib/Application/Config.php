<?php
/**
 * Configuration class
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */
namespace Application;

class Config implements \Countable, \Iterator {
        
    private $_data;
    
    private $_allowModifications;
    
    public function __construct(array $array, $allowModifications = false) {
        $this->_allowModifications = (boolean) $allowModifications;
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->_data[$key] = new self($value, $this->_allowModifications);
            } else {
                $this->_data[$key] = $value;
            }
        }
    }

    public function count() {
        
    }

    public function current() {
        
    }

    public function key() {
        
    }

    public function next() {
        
    }

    public function rewind() {
        
    }

    public function valid() {
        
    }
    
    public function __get($name)
    {
        return $this->get($name);
    }
    
    public function get($name, $default = null)
    {
        $result = $default;
        if (array_key_exists($name, $this->_data)) {
            $result = $this->_data[$name];
        }
        return $result;
    }
}