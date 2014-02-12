<?php
/**
 * Configuration class
 * @author Miroslav Milosevic <m.maksa@gmail.com>
 */
namespace Application;

class ConfigIni {
    
    /**
     * config file path
     * @var type (string)
     */
    private $configFile;
    
    /**
     * Environment
     * @var type (string)
     */
    private $environment;
    
    /**
     * File extension
     * @var type (string)
     */
    private $fileExtension;
    
    /**
     * Loaded configuration from parsed ini file
     * @var type (array)
     */
    private $configuration;
    
    /**
     * configuration line separator
     * @var type (string)
     */
    private $configLineSeparator;
    
    /**
     * Singleton class instance
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
    
    public function __construct($configFile) {
        $this->configFile = $configFile;
        $this->fileExtension = '.ini';
        $this->configLineSeparator = '.';
        $this->configuration = new \stdClass();
    }
    
    private function _getEnvironment() {
        $this->environment = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
        return $this->environment;
    }
    
    public function load() {
        if($this->_fileExists($this->configFile)) {
            $this->_parseConfig();
            $this->defineConstants();
        }
    }
    
    private function _fileExists($file) {
        return file_exists($file) && strpos($file, $this->fileExtension);
    }
    
    private function _parseConfig() {
        try {
            error_reporting(false);
            $conf = parse_ini_file($this->configFile, true);
            $this->_getEnvironment();
            foreach($conf[$this->environment] as $key => $value) {
                $pieces = explode($this->configLineSeparator, $key);
                $thisSection = trim($pieces[0]);
                switch(count($pieces)) {
                    case 1:
                        $this->configuration->$thisSection = $value;
                        break;
                    case 2: 
                        $this->configuration->$thisSection->$pieces[1] = $value;
                    case 3:
                        $this->configuration->$thisSection->$pieces[1]->$pieces[2] = $value;
                    default:
//                        throw new Exception("Invalid config file".PHP_EOL, 200);
                }
            }
            error_reporting();
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    
    private function defineConstants() {
        define('db_host', $this->configuration->database->db->host);
        define('db_name', $this->configuration->database->db->name);
        define('db_user', $this->configuration->database->db->user);
        define('db_pass', $this->configuration->database->db->password);  
        define('debug', $this->configuration->application->debug);
    }
    
    public function getConfig() {
        return (object) $this->configuration;
    }
        
}

class Configuration {
    
    public function set($property, $value) {
        $this->$property = $value;
    }
    
}