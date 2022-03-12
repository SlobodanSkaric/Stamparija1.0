<?php
namespace Pre\Controller;

use Pre\Model\UserModel;

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

       if($password1 != $password2){
            $this->set("message", "Oba pasvarda moraju biti ista.");
            return;
       }

       $pasHesh   = password_hash($password1, PASSWORD_DEFAULT);

       $userModel = new UserModel($this->getConnection());

       $result = $userModel->add([
           "firstname" => $name,
           "lastname"  => $lastName,
           "username"  => $username,
           "password"  => $pasHesh,
           "email"     => $email
       ]);
        
       if(isset($result)){
           $this->set("message", "Uspesno ste kreirali nalog");
           $this->redirect("/press/");
           return;
       }

       $this->set("message", "Doslo je do greske pri kreiranju naloga.");
    }
}