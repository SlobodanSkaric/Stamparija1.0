<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
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
        
        $logMaterial = new LogMaterialModel($this->getConnection());

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

        

        if(isset($add)){
            $this->redirect("/press/material/");
        }
    }
}