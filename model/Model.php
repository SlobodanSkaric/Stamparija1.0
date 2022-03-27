<?php
namespace Pre\Model;

use Exception;
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

    public function getFilds(){
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

    private function checkedFiledList($data,$value){
        $fildSuported = $this->getFilds();

        if(!array_key_exists($data, $fildSuported)){
            throw  new Exception("Fild name " . $data . " is not siported...");
        }

        if(!$fildSuported[$data]->isValid($value)){
            throw new Exception("This value is not valid.");
        }
    }

    private function checkedAllFiledList($data){
        $fildeSuport = $this->getFilds();

        $suportedFildeName   = array_keys($fildeSuport);
        $requestedFildeNames = array_keys($data);

        foreach($requestedFildeNames as $requestedFildeName){
            
            if(!in_array($requestedFildeName, $suportedFildeName)){
                throw new \Exception("Fild name " . $requestedFildeName . " is not suported");
            }
            
            if(!$fildeSuport[$requestedFildeName]->editTable()){
                throw new \Exception("Filde " . $requestedFildeName . " is not editable");
            }
           
            if(!$fildeSuport[$requestedFildeName]->isValid($data[$requestedFildeName])){
                throw new \Exception("Value in" . $data[$requestedFildeName]. " filde is not valid");
            }
        }
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
        $this->checkedFiledList($fildName, $value);
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

    public function getFildAll($fildName, $value){
        $this->checkedFiledList($fildName, $value);
        $tableName = $this->getTableName();

        $sql = "SELECT * FROM {$tableName} WHERE {$fildName}=?";
        $prepare = $this->getDbc()->prepare($sql);
        $execute = $prepare->execute([$value]);
        $result = [];

        if($execute){
            $result = $prepare->fetchAll(PDO::FETCH_OBJ);
        }

        return $result;
    }

    public function getLike($filedName, $value){

    }

    public function add($data){
        $this->checkedAllFiledList($data);
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

    public function update($id, $data){
        $tableName = $this->getTableName();

        $this->checkedAllFiledList($data);

        $editList  = [];
        $value     = [];

        foreach($data as $dataName=>$dataValue){
            $editList[]  = "{$dataName}=?";
            $value[]     = $dataValue;
        }

        $edit    = implode(",", $editList);
        $value[] = $id;

        $sql     = "UPDATE {$tableName} SET {$edit} WHERE {$tableName}_id=?";
        $prep    = $this->getDbc()->prepare($sql);
        $execute = $prep->execute($value);

        return $execute;
    }
}