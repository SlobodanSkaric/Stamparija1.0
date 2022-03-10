<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\LogMaterialModel;

class UserController extends UserRole{
    public function show(){
        $logMaterial = new LogMaterialModel($this->getConnection());
        $data        = $logMaterial->getAll();
        $this->set("material", $data);
    }
}