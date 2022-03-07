<?php
namespace Pre\Model;

class MainModel{
    private $dbc;

    public function __construct($dbc){
        $this->dbc = $dbc;
    }

    public function getAllMaterial(){
        $sql = "SELECT * FROM pmaterial";
        $prepare = $this->dbc->prepare($sql);
        $users = [];

        if(!$prepare){
            return null;
        }

        $execute = $prepare->execute();

        if($execute){
            $users = $prepare->fetchAll(\PDO::FETCH_OBJ);
        }

        return $users;
    }
}