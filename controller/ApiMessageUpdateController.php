<?php
namespace Pre\Controller;

use Pre\Model\NoteModel;

class ApiMessageUpdateController extends ApiController{
    public function updateNote($messId){
       $noteModel  = new NoteModel($this->getConnection());
       $noteModel->update($messId, ["status" => 0]); 
     }
}