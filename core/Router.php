<?php
namespace Pre\Core;

class Router{
    private $urlMethod;
    private $pattern;
    private $controller;
    private $method;
   
    public function __construct($urlMethod, $pattern, $controller, $method){
        $this->urlMethod    = $urlMethod;
        $this->pattern      = $pattern;
        $this->controller   = $controller;
        $this->method       = $method;
    }

    public static function get($pattern, $controller, $method){
        return new Router("GET", $pattern, $controller, $method);
    }

    public static function post($pattern, $controller, $method){
        return new Router("POST", $pattern, $controller, $method);
    }

    public static function any($pattern, $controller, $method){
        return new Router("GET|POST", $pattern, $controller, $method);
    }

    public function metch($url, $method){
        if(!preg_match($this->pattern, $url)){
            return false;
        }

        if(!preg_match("|^" . $this->urlMethod . "$|", $method)){
            return false;
        }

        return true;
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function exractArgumnent($url){
        $arguments = [];
        $result= [];

        preg_match_all($this->pattern, $url, $arguments);
        //print_r($this->pattern);
        if(isset($arguments[1])){
            $result = $arguments[1];
        }

        return $result;
    }
}