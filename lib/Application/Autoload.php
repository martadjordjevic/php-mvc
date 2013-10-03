<?php
/**
 * Autoloader class 
 * PSR-0 compliant autoloader
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */

class Autoloader {

    private $_directory;
    
    private $_fileExtension;

    private $_prefix;
    
    private $_wordSeparator;
    
    public function __construct($baseDirectory = __DIR__) {
        $this->_directory = $baseDirectory;
        $this->_prefix = __NAMESPACE__ . '\\';
        $this->_wordSeparator = array('\\', '_');
        $this->_fileExtension = '.php';
    }
    
    public static function register($prepend = false) {
        return spl_autoload_register(array(new self, 'autoload'), true, $prepend);
    }
    
    public static function registerModuleAutoloader($autoloadObj, $prepend = false) {
        return spl_autoload_register(array($autoloadObj, 'autoloadModule'), true, $prepend);
    }
    
    public static function unregister() {
        return spl_autoload_unregister(array(new self, 'autoload'));
    }
    
    public function autoload($class) {
        if($this->_classExists($class)) {
            return false;
        }
        $classFilePath = realpath($this->_directory . '/../')
                       . DIRECTORY_SEPARATOR
                       . trim(str_replace($this->_wordSeparator, DIRECTORY_SEPARATOR, $class))
                       . $this->_fileExtension;
        
        if(!file_exists($classFilePath) || !is_readable($classFilePath)) {
            return false;
        }
        
        require_once( $classFilePath );
    }
    
    public function autoloadModule($class) {
        if($this->_classExists($class)) {
            return false;
        }
        $classFilePath = realpath($this->_directory)
                       . DIRECTORY_SEPARATOR
                       . trim(str_replace($this->_wordSeparator, DIRECTORY_SEPARATOR, $class))
                       . $this->_fileExtension;
        
        if(!file_exists($classFilePath) || !is_readable($classFilePath)) {
            return false;
        }
        
        require_once( $classFilePath );
    }
    
    private function _classExists($class) {
        return class_exists($class, false)
            || interface_exists($class, false)
            || (function_exists('trait_exists') ? trait_exists($class, false) : false)
            || strpos($class, $this->_prefix) === false;
    }
    
}