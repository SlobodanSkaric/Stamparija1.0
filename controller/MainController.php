<?php
namespace Pre\Controller;

use Pre\Model\PmaterialModel;
use Pre\Model\MainModel;

class MainController extends Controller{
    public function home(){
        $mainModel   = new PmaterialModel($this->getConnection());
        $usersResult = $mainModel->getAll();
        $this->set("pmaterial", $usersResult);
    }
}