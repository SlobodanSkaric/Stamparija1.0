<?php 
namespace Pre\Model;

use Pre\Core\Field;
use Pre\Validators\StringValidator;

class UserModel extends Model{
    protected function getFilds(){
        return [
            "firstname"     => new Field((new StringValidator)->maxStringLenght(50)),
            "lastname"      => new Field((new StringValidator)->maxStringLenght(50)),
            "username"      => new Field((new StringValidator)->maxStringLenght(50)),
            "password_hash" => new Field((new StringValidator)->maxStringLenght(60)),
            "email"         => new Field((new StringValidator)->maxStringLenght(60))
        ];
    } 
}