<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\IniMaterialMode;
use Pre\Model\IniMaterialModel;
use Pre\Model\LogMaterialModel;
use Pre\Validators\StringValidator;

class MaterialController extends UserRole{
    
    public function show(){
        $losgmaterialModel = new LogMaterialModel($this->getConnection());
        $data = $losgmaterialModel->getAll();

        $this->set("setmaerial", $data);
    }

    public function record(){
        $nummaterial    = filter_input(INPUT_POST, "numbermaterial", FILTER_SANITIZE_STRING);
        $countMataerial = filter_input(INPUT_POST, "countmaterial", FILTER_SANITIZE_STRING);
        $mark           = filter_input(INPUT_POST, "mark", FILTER_SANITIZE_STRING);
        $user           = $this->getSession()->get("user_id");
        $active         = 1;

        #material_ini

        $arrIniNum      = [];

        $ini348805      = filter_input(INPUT_POST, "ini348805", FILTER_SANITIZE_STRING);
        $ini348804      = filter_input(INPUT_POST, "ini348804", FILTER_SANITIZE_STRING);
        $ini523341      = filter_input(INPUT_POST, "ini523341", FILTER_SANITIZE_STRING);
        $ini656361      = filter_input(INPUT_POST, "ini656361", FILTER_SANITIZE_STRING);
        $ini566843      = filter_input(INPUT_POST, "ini566843", FILTER_SANITIZE_STRING);
        $ini566844      = filter_input(INPUT_POST, "ini566844", FILTER_SANITIZE_STRING);

        $sum348805      = filter_input(INPUT_POST, "sum348805", FILTER_SANITIZE_NUMBER_INT);
        $sum348804      = filter_input(INPUT_POST, "sum348804", FILTER_SANITIZE_NUMBER_INT);
        $sum523341      = filter_input(INPUT_POST, "sum523341", FILTER_SANITIZE_NUMBER_INT);
        $sum656361      = filter_input(INPUT_POST, "sum656361", FILTER_SANITIZE_NUMBER_INT);
        $sum566843      = filter_input(INPUT_POST, "sum566843", FILTER_SANITIZE_NUMBER_INT);
        $sum566844      = filter_input(INPUT_POST, "sum566844", FILTER_SANITIZE_NUMBER_INT);

        if($ini348805 != NULL){
            $arrIniNum["348805"] = $ini348805 + $sum348805;
        }
        if($ini348804 != NULL){
            $arrIniNum["348804"] = $ini348804 + $sum348804;
        }
        if($ini523341 != NULL){
            $arrIniNum["523341"] = $ini523341 + $sum523341;
        }
        if($ini656361 != NULL){
            $arrIniNum["656361"] = $ini656361 + $sum656361;
        }
        if($ini566843 != NULL){
            $arrIniNum["566843"] = $ini566843 + $sum566843;
        }
        if($ini566844 != NULL){
            $arrIniNum["566844"] = $ini566844 + $sum566844;
        }

       

        
        
        $logMaterial      = new LogMaterialModel($this->getConnection());
        $iniMaterialModel = new IniMaterialModel($this->getConnection());

        if((new StringValidator())->stricStringLenght(12)->strictValid($nummaterial)){
            $this->set("message", "Format broja naloga nije ispravan. Nalog mora imati tacno 12 cifara.");
            return;
        }

        if(!preg_match("|^[1-9][0-9]+$|", $nummaterial)){
            $this->set("message", "Broj naloga moze sadrzati samo cifre");
            return;
        }

        $add = $logMaterial->add([
            "numbr_material" => $nummaterial,
            "user"           => $user,
            "count"          => $countMataerial,
            "is_activ"       => $active,
            "mark"           => $mark
        ]);

       foreach($arrIniNum as $iniNumKey => $iniNumVal){
            $iniNum = strval($iniNumKey);

            $ini = $iniMaterialModel->add([
                "number_material"     => $nummaterial,
                "number_material_ini" => $iniNum,
                "count_ini"           => $iniNumVal,
                "user"                => $user
            ]);
        }
        

        if(isset($add)){
            $this->redirect("/press/material/");
        }
    }
}