<?php
namespace Pre\Core;

class DatabaseConfiguration{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function __construct($hostname, $username, $password, $dbname, $charset){
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname   = $dbname;
        $this->charset  = $charset;
    }

    public function getSourceDns():string{
        return "mysql:hostname={$this->hostname};dbname={$this->dbname};charset={$this->charset}";
    }

    public function getUsername():string{
        return $this->username;
    }

    public function getPassword():string{
        return $this->password;
    }
}