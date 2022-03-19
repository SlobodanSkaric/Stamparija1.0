<?php
namespace Pre\Validators;

use Pre\Core\Validator;
use Stringable;

class StringValidator implements Validator{
    private $minStringLenght;
    private $maxStringLenght;

    public function __construct(){
        $this->minStringLenght = 0;
        $this->maxStringLenght = 80;
    }

    public function minStrinLenght($minStr):StringValidator{
        $this->minStringLenght = $minStr;
        return $this;
    }

    public function maxStringLenght($max):StringValidator{
        $this->maxStr = $max;
        return $this;
    }
    
    public function isValid(string $value): bool{
        return boolval($this->minStringLenght < $value && $this->maxStringLenght > $value);
    }
}