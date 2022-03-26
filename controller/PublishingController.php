<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\LogMaterialModel;

class PublishingController extends UserRole{
    public function show(){
        $logMaterialModel = new LogMaterialModel($this->getConnection());
        $logMaterial      = $logMaterialModel->getFildAll("is_activ", 1);
        
        $this->set("material", $logMaterial);
    }
}