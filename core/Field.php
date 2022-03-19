<?php
namespace Pre\Core;

class Field{
    private $validator;
    private $editable;

    public function __construct(Validator $valid, $editable=true){
        $this->validator = $valid;
        $this->editable  = $editable;
    }

    public function isValid($value){
        return $this->validator->isValid($value);
    }

    public function editTable(){
        return $this->editable;
    }
}