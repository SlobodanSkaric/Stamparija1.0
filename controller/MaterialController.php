<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\LogMaterialModel;

class MaterialController extends UserRole{
    
    public function show(){
        
    }

    public function record(){
        $nummaterial    = filter_input(INPUT_POST, "numbermaterial", FILTER_SANITIZE_STRING);
        $countMataerial = filter_input(INPUT_POST, "countmaterial", FILTER_SANITIZE_STRING);
        $mark           = filter_input(INPUT_POST, "mark", FILTER_SANITIZE_STRING);
        $user           = $this->getSession()->get("user_id");
        $active         = 1;

        $logMaterial = new LogMaterialModel($this->getConnection());

        $add = $logMaterial->add([
            "numbr_material" => $nummaterial,
            "user" => $user,
            "count" => $countMataerial,
            "is_activ" => $active,
            "mark" => $mark
        ]);

        if($add){
            $this->redirect("/press/material/");
        }
    }
}