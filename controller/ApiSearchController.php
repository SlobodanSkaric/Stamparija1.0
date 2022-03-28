<?php
namespace Pre\Controller;

use Pre\Model\LogMaterialModel;

class ApiSearchController extends ApiController{
    public function search($numberMaterial){
        $logMaterialModel = new LogMaterialModel($this->getConnection());
        $logSearchMaerial = $logMaterialModel->search("numbr_material",$numberMaterial);
        
        $this->set("material", $logSearchMaerial);
    }
}