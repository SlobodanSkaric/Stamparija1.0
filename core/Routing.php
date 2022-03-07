<?php
namespace Pre\Core;

class Routing{
    private $routes = [];

    public function __construct(){ }

    public function addRoute(Router $router){
        $this->routes[] = $router;
    }

    public function metchRote($url, $method){
        foreach($this->routes as $route){
            if($route->metch($url, $method)){
                return $route;
            }
        }

        return null; //This is never execute becasu existe fold back route
    }
}