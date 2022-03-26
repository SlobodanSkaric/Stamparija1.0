<?php
namespace Pre\Model;

use Pre\Core\Field;
use Pre\Validators\IntegerValidator;
use Pre\Validators\StringValidator;

class IniMaterialModel extends Model{
    public function getFilds()
    {
        return [
            "ini_material_id"     => new Field((new IntegerValidator())->intLenght(11), false),

            "number_material"     => new Field((new StringValidator())->maxStringLenght(50)),
            "number_material_ini" => new Field((new StringValidator())->maxStringLenght(50)),
            "count_ini"           => new Field((new IntegerValidator())->intLenght(11)),
            "user"                => new Field((new IntegerValidator())->intLenght(11))
        ];
    }
}