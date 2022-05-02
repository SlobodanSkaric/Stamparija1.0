<?php
namespace Pre\Core;

class DatabseConnection{
    private static  $dbc;
    private static $connection;
    private $dns;

    private function __construct(DatabaseConfiguration $dbconfig){
        $this->dns = $dbconfig;
    }

    public static function getInstnce(DatabaseConfiguration $dbconfig){
        if(!isset(self::$dbc)){
            self::$dbc = new static($dbconfig);
        }
       
        return self::$dbc;
    }

    public function getConnectionSing():\PDO{
       
            self::$connection =  new \PDO($this->dns->getSourceDns(),$this->dns->getUsername(),$this->dns->getPassword());
           
            return self::$connection;
    }
}