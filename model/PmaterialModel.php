<?php
namespace Pre\Model;

use Pre\Core\Field;
use Pre\Validators\IntegerValidator;
use Pre\Validators\StringValidator;

class PmaterialModel extends Model{
    public function getFilds(){
        return [
            "material_number"   => new Field((new StringValidator())->maxStringLenght(50)),
            "user"              => new Field((new IntegerValidator())->intLenght(11)),
            "date_time"         => new Field((new StringValidator())->maxStringLenght(100)),
            "username"          => new Field((new StringValidator())->maxStringLenght(50))
        ];
    }

    public function getMaterial(string $numberMaterial){
        
    }
}