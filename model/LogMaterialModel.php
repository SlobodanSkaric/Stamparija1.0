<?php
namespace Pre\Model;

use InternalIterator;
use Pre\Core\Field;
use Pre\Validators\IntegerValidator;
use Pre\Validators\StringValidator;

class LogMaterialModel extends Model{
    public function getFilds(){
        return [
            "numbr_material"   => new Field((new StringValidator())->maxStringLenght(50)),
            "user"             => new Field((new IntegerValidator())->intLenght(11)),
          //"create_at"        => new Field((new StringValidator())->maxStringLenght(100)),
            "publishing"       => new Field((new StringValidator())->maxStringLenght(100)),
            "count"            => new Field((new IntegerValidator())->intLenght(11)),
            "is_activ"         => new Field((new IntegerValidator())->intLenght(11)),
            "mark"             => new Field((new StringValidator())->maxStringLenght(50))
        ];
    }
}