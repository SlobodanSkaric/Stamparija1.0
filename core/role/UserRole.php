<?php
namespace Pre\Core\Role;

use Pre\Controller\Controller;

class UserRole extends Controller{
    public function rol(){
        $role = $this->getSession()->get("user_id", null);

        if($role == null){
            $this->redirect("press/login");
        }
    }
}