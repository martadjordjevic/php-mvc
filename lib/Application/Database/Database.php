<?php
namespace Application\Database;
use Application\Registry;

class Database {
    private $link;

    private static $instance;

    public static function getInstance() {
        if(!self::$instance) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
    
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;

    private $debug;
    //public $db;
    public $rows = array();
    public $row;
    public $count;
    public $object;

    var $result;

    //var $link = NULL;
    var $queries = NULL;
    var $errors = NULL;

    var $databaseExtras = NULL;

    function __construct() {
        $this->getConnectionConfig();
        $this->databaseConnection();
    }

    // connection to database
    function databaseConnection() {
        $this->link = "";
        $this->queries = array ();
        $this->errors = array ();

        $this->databaseExtras = new \stdClass;
        try {
            $this->link = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            mysql_select_db($this->db_name);
            mysql_query("SET NAMES 'utf8'", $this->link);
            if(!$this->link) {
                throw new Exception('Could not connect to database');
            }
        } catch (Exception $ex) {
            if(debug) {
                echo "<b>Exception: </b>".$ex->getTraceAsString();
            } else {
                echo "<b>Exception: </b>".$ex->getMessage();
            }
            exit();
        }
    }
    /**
     * This method process all queries results
     * @param type $sql 
     */
    public function query($sql) {
//        echo "<div style=\"text-align:center;\">".$sql."<br /></div>";
        $this->result = mysql_query($sql, $this->link);
    }
    /**
     * Return multiple rows
     * @param type $sql
     * @return type 
     */
    public function getRows($sql) {
        $rows = array();
        $data = $this->query($sql);
        while($row = mysql_fetch_assoc($this->result)) {
            array_push($rows, $row);
        }
        mysql_free_result($this->result);
        return $this->rows = $rows;
    }
    
    /**
     * Return single row
     * @param type $sql
     * @return type 
     */
    public function getRow($sql) {
        $data = $this->query($sql);
        $row = mysql_fetch_assoc($this->result);
        mysql_free_result($this->result);
        return $this->row = $row;
    }
    
    /**
     * Return number of rows
     * @param type $sql
     * @return type 
     */
    public function getScalar($sql) {

        //$data = mysql_query($sql, $this->link); 
        $data = $this->query($sql);
        $count = mysql_num_rows($this->result);
        mysql_free_result($this->result);
        return $this->count = $count;

    }
    
    /**
     * Return results as object
     * @param type $sql
     * @return type 
     */
    public function getObject($sql) {
        $data = $this->query($sql);
        $object = mysql_fetch_object($this->result);
        mysql_free_result($this->result);
        return $this->object = $object;                
    }
    
    /**
     * Return set of objects
     * @param type $sql
     * @return type (object)
     */
    public function getObjects($sql) {
        $data = $this->getRows($sql);
        return $this->arrayToObject($data);
    }
    
    /**
     * mysql stored procedure call
     */
    public function callProcedure($procedureName) {
        $sql = "CALL".$procedureName();
        $data = $this->query($sql);
        return $data;
    }


    /**
     * Return inserted id
     */
    public function insertedId() {
        return mysql_insert_id($this->link);
    }
    
    /**
     * Converts array to obejct
     * @param type $d
     * @return type (object)
     */
    private static function arrayToObject($d) {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__CLASS__."::".__FUNCTION__, $d);
        }
        else {
            // Return object
            return $d;
        }
    }
    
    private function getConnectionConfig() {
        $config = Registry::get('config');
        $this->db_host = $config->database->dbHost;
        $this->db_name = $config->database->dbName;
        $this->db_user = $config->database->dbUser;
        $this->db_pass = $config->database->dbPass;
        $this->debug = $config->application->debug;
    }
    
}