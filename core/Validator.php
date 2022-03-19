<?php
namespace Pre\Core;

interface Validator{
    public function isValid(string $value):bool;
}