<?php
namespace Pre\Controller;

use Pre\Model\MainModel;

class MainController extends Controller{
    public function home(){
        $mainModel   = new MainModel($this->getConnection());
        $usersResult = $mainModel->getAllMaterial();
        $this->set("pmaterial", $usersResult);
    }
}