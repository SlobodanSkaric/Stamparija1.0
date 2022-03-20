<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\LogMaterialModel;
use Pre\Model\UserModel;

class MaterialPanelController extends UserRole{
    public function show($numberMaterial){
        $logMaterialModel = new LogMaterialModel($this->getConnection());
        $materialResult   = $logMaterialModel->getFild("numbr_material", $numberMaterial);

        $this->set("material", $materialResult);

        $userModel  = new UserModel($this->getConnection());
        $userResutl = $userModel->getFild("user_id", $materialResult->user);
        
        $this->set("user", $userResutl);
    }
}