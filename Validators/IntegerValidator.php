<?php
namespace Pre\Validators;

use Pre\Core\Validator;

class IntegerValidator implements Validator{
    private $isSingt;
    private $isDecimal;
    private $intLenght;

    public function __construct(){
        $this->isSingt   = false;
        $this->isDecimal = false;
        $this->intLenght = 11;
    }

    public function intLenght($len):IntegerValidator{
        $this->intLenght = $len;
        return $this;
    }

    public function isSingt():IntegerValidator{
        $this->isSingt = true;
        return $this;
    }

    public function isDecimal(){
        $this->isDecimal = true;
        return $this;
    }

    public function isValid(string $value): bool{
        $pre = "|^";

        if($this->isSingt){
            $pre .= "\-";
        }

        $pre .= "[1-9][0-9]{0,". $this->intLenght ."}";

        if($this->isDecimal){
            $pre .= "\.[0-9]{1,3}";
        }

        $pre .= "$|";

        return boolval(preg_match($pre, $value));
    }
}