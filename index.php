<?php

require "vendor/autoload.php";

use Pre\Controller\MainController;
use Pre\Core\ConfigurationPara;
use Pre\Core\DatabaseConfiguration;
use Pre\Core\DatabseConnection;
use Pre\Model\MainModel;

$dbconfig   = new DatabaseConfiguration(ConfigurationPara::HOSTNAME,ConfigurationPara::USERNAME,ConfigurationPara::PASSWORD,ConfigurationPara::DBNAME,ConfigurationPara::CHARSET);
$conne      = new DatabseConnection($dbconfig);

$url        = filter_input(INPUT_GET, "URL");
$method     = filter_input(INPUT_SERVER, "REQUEST_METHOD");

$routing    = new \Pre\Core\Routing();
$routes     = require_once "Route.php";

foreach($routes as $route){
    $routing->addRoute($route);
}

$foundRoute = $routing->metchRote($url, $method);

$controllerName = "Pre\\Controller\\" .  $foundRoute->getController() . "Controller";
$methodName = $foundRoute->getMethod();

$controller = new $controllerName($conne);
$argumments = [];

call_user_func_array([$controller, $methodName], $argumments);

$data = $controller->getData();

$loader  =  new \Twig\Loader\FilesystemLoader("./view");
$twig    =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);

echo $twig->render($foundRoute->getController() . "/" . $foundRoute->getMethod() . ".html", $data);