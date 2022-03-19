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

    protected function getFilds(){
        return [];
    }
    
    private function getTableName(){
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

    public function getFild($fildName, $value){
        $tableName = $this->getTableName();

        $sql = "SELECT * FROM {$tableName} WHERE {$fildName}=?";
        $prepare = $this->getDbc()->prepare($sql);
        $execute = $prepare->execute([$value]);
        $result = NULL;

        if($execute){
            $result = $prepare->fetch(PDO::FETCH_OBJ);
        }

        return $result;
    }

    public function add($data){
        $tableName = $this->getTableName();
        
        $dataKey   = array_keys($data);
        $dataValue = array_values($data);
        
        $tableFildvalue      = implode(",", $dataKey);
        $questionMarksRepeat = str_repeat("?,", count($data));
        $questionMarks       = substr($questionMarksRepeat,0,-1);
        
        $sql     = "INSERT INTO {$tableName} ({$tableFildvalue}) VALUES ({$questionMarks})";
        $prepare = $this->getDbc()->prepare($sql);
        $execute = $prepare->execute($dataValue);

        if(!$execute){
            return false;
        }

        return $this->getDbc()->lastInsertId();
    }

}