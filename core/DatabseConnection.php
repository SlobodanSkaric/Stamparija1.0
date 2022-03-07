<?php
namespace Pre\Core;

class DatabseConnection{
    private $connection;
    private $dns;

    public function __construct(DatabaseConfiguration $dbconfig){
        $this->dns = $dbconfig;
    }

    public function getConnectionSing():\PDO{
        if($this->connection === null){
            $this->connection =  new \PDO($this->dns->getSourceDns(),$this->dns->getUsername(),$this->dns->getPassword());
        }

        return $this->connection;
    }
}