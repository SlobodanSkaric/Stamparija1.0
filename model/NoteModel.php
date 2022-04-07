<?php
namespace Pre\Model;

use Pre\Core\Field;
use Pre\Validators\IntegerValidator;
use Pre\Validators\StringValidator;

class NoteModel extends Model{
    public function getFilds(){
        return [
            "note_id"      => new Field((new IntegerValidator())->intLenght(11),false),

            "status"       => new Field((new IntegerValidator())->intLenght(11)),
            "note_text"    => new Field((new StringValidator())->maxStringLenght(60000)),
            "user"         => new Field((new IntegerValidator())->intLenght(11)),
            "note_subject" => new Field((new StringValidator())->maxStringLenght(255))
        ];
    }
}