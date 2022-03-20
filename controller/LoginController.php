<?php
namespace Pre\Controller;

use Pre\Model\UserModel;

class LoginController extends Controller{
    public function show(){
        
    }

    public function login(){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        $userModel = new UserModel($this->getConnection());

        $usernameCheck = $userModel->getFild("username",$username);
        $passwordCheck =  $usernameCheck->password_hash ?? "";
        
        if(!$usernameCheck){
            $this->set("message", "Ne postoji korisnik sa ovim korisnickim imenom.");
            return;
        }

        if(!password_verify($password, $passwordCheck)){
            $this->set("message", "Lozinka nije ispravna");
            return;
        }

        $this->getSession()->put("user_id", $usernameCheck->user_id);
        $this->getSession()->saveSession();
        
        $this->getSession()->reload();

        $this->redirect("/press/material/".$usernameCheck->user_id);


        //$this->set("message", $usernameCheck->user_id);

  
    }
}