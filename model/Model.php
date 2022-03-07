<?php
namespace Pre\Model;

use PDO;

 class Model{
    private $dbc;
    private $data = [];

    public function __construct($dbc){
        $this->dbc = $dbc;
    }

    protected function getDbc(){
        return $this->dbc;
    }
    
    public function getTableName(){
        $className  = static::class;
        $tempName   = [];
        preg_match("|^Pre\\\Model\\\([A-Z][a-z]+([A-Z][a-z]+)?)Model$|",$className, $tempName);
        $className       = $tempName[1] ?? null;
        $classUnderscore = preg_replace("|[A-Z]|","_$0", $className);
        $calssSubst      = substr($classUnderscore,1); 
        $tableName       = strtolower($calssSubst);

        return $tableName;
    }

    public function getAll(){
        $tableName = $this->getTableName();

        $sql     = "SELECT * FROM {$tableName}";
        $prep    = $this->getDbc()->prepare($sql);
        $execute = $prep->execute();
        $res     = [];

        if($execute){
            $res = $prep->fetchAll(PDO::FETCH_OBJ);
        }

        return $res;
    }

}