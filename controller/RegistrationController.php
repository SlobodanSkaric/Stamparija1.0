<?php
namespace Pre\Controller;

use Pre\Model\UserModel;
use Pre\Validators\StringValidator;

class RegistrationController extends Controller{
    public function show(){
        
    }

    public function rgistration(){
        $name       = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $lastName   = filter_input(INPUT_POST, "lastname" , FILTER_SANITIZE_STRING);
        $username   = filter_input(INPUT_POST, "usname", FILTER_SANITIZE_STRING);
        $email      = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password1  = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $password2  = filter_input(INPUT_POST, "passrepeat", FILTER_SANITIZE_STRING);

        $stringValidator = new StringValidator();
        
        
        if(!$stringValidator->minStrinLenght(6)->maxStringLenght(20)->isValid($password1)){
            $this->set("message", "Duzina lozine najmanje 6 a najvise 20 krktera");
            return;
        }

        if($password1 != $password2){
                $this->set("message", "Obe lozinke moraju biti ista.");
                return;
        }

        $userModel = new UserModel($this->getConnection());
        $checkUsernam = $userModel->getFild("username", $username);

        if($checkUsernam == true){
            $this->set("message", "Korisnik sa ovim korisnickim imenom vec postoji.");
            return;
        }

        $pasHesh   = password_hash($password1, PASSWORD_DEFAULT);

       

        $result = $userModel->add([
            "firstname"      => $name,
            "lastname"       => $lastName,
            "username"       => $username,
            "password_hash"  => $pasHesh,
            "email"          => $email
        ]);
        
        if(isset($result)){
            $this->set("message", "Uspesno ste kreirali nalog");
            $this->redirect("/press/");
            return;
        }

        $this->set("message", "Doslo je do greske pri kreiranju naloga.");
    }
}