<?php
namespace Pre\Controller;

use Pre\Model\NoteModel;

class ApiMessageController extends ApiController{
    public function unrideNotes(){
        $noteModel = new NoteModel($this->getConnection());
        $unredNote = $noteModel->getAll();

        $this->set("unreadnotes", $unredNote);
    }

   
}