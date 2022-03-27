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

    public function search(string $numberMaterial){

    }

    public function pub(){
        $checked = filter_input(INPUT_POST, "valche", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        $dateTime = date("Y-m-d H:i:s");
       
        $logMaterilaModel = new LogMaterialModel($this->getConnection());

        $dataList = [
            "is_activ"   => 0,
            "publishing" =>  $dateTime
        ];

        foreach($checked as $data=>$value){
            $logMaterilaModel->update($value, $dataList);
        }

        $this->redirect("/press/publishing");
    }
}