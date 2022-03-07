<?php
// This is old model not curen use
/* namespace Pre\Model;

class MainModel extends Model{
    
    public function getAllMaterial(){
        $sql = "SELECT 
            pmaterial.material_number,
            user.username
         FROM pmaterial
         INNER JOIN user ON pmaterial.user = user.user_id";
        $prepare = $this->getDbc()->prepare($sql);
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
} */