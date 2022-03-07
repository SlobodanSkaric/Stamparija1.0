<?php
namespace Pre\Controller;

use Pre\Core\DatabseConnection;

class Controller{
    private $dbc;
    private $data = [];

    public function __construct(DatabseConnection $dbc){
        $this->dbc = $dbc;
    }

    public function getConnection(){
        return $this->dbc->getConnectionSing();
    }

    protected function set(string $dataName, $value){
        if(preg_match("|^[a-z][a-z0-9]+([A-Z][a-z0-9]+)*$|", $dataName)){
            $this->data[$dataName] = $value;
            return true;
        }
        return false;
    }

    public function getData(){
        return $this->data;
    }
}
