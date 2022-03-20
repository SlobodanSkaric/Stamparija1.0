<?php
namespace Pre\Validators;

use Pre\Core\Validator;
use Stringable;

class StringValidator implements Validator{
    private $minStringLen;
    private $maxStringLen;
    private $strictStringLen;

    public function __construct(){
        $this->minStringLen = 0;
        $this->maxStringLen = 80;
        $this->stricStringLenght = 0;
    }

    public function minStrinLenght($min):StringValidator{
        $this->minStringLen = $min;
        return $this;
    }

    public function maxStringLenght($max):StringValidator{
        $this->maxStringLen = $max;
        return $this;
    }
    
    public function stricStringLenght($strict):StringValidator{
        $this->strictStringLen = $strict;
        return $this;
    }

    public function isValid(string $value): bool{
        $len = strlen($value);
      
        return boolval($this->minStringLen <= $len && $len <= $this->maxStringLen);
    }

    public function strictValid($value){
        $len = strlen($value);

        return boolval($this->strictStringLen != $len);
    }
}