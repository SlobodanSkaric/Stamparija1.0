<?php
namespace Pre\Controller;

use Pre\Core\Role\UserRole;
use Pre\Model\NoteModel;

class NoteController extends UserRole{

    public function show(){

    }

    public function postNote(){
        $subject = filter_input(INPUT_POST, "sub", FILTER_SANITIZE_STRING);
        $note    = nl2br(filter_input(INPUT_POST, "note",FILTER_SANITIZE_STRING));
        $status  = 1;
        $user    = $this->getSession()->get("user_id");

        if($subject == "") $subject = "Poruka je bez naslova";
       
       $noteModel = new NoteModel($this->getConnection());
       $noteModel->add([
           "status"       => $status,
           "note_text"    => $note,
           "user"         => $user,
           "note_subject" => $subject
       ]);

       $this->redirect("/press/note");
    }

    public function unrideNote(){
        
    }
}