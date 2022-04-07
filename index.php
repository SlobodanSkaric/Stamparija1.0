<?php

require "vendor/autoload.php";

ob_clean();

use Pre\Controller\MainController;
use Pre\Core\ConfigurationPara;
use Pre\Core\DatabaseConfiguration;
use Pre\Core\DatabseConnection;
use Pre\Core\Session\SessionManaged;
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
$argumments = $foundRoute->exractArgumnent($url);
//print_r($argumments);exit;

$controllerName = "Pre\\Controller\\" .  $foundRoute->getController() . "Controller";
$controller     = new $controllerName($conne);
$methodName     = $foundRoute->getMethod();

$sesionDataconst  = ConfigurationPara::SESSION_CLASS_INSTANCE;
$sessionPath      = ConfigurationPara::SESSION_PATH;
$sessionInstance  = new $sesionDataconst(...$sessionPath);

$fingerPrintClass  = ConfigurationPara::FINGER_PRINT_PDOVIDER_FACTORY;
$fingerPrintethod  = ConfigurationPara:: FINGER_PRINT_METHOD;
$fingerPrintParam  = ConfigurationPara::FINGER_PRINT_PARAMETER;
$fingerPrintFacIns = new $fingerPrintClass();
$fingerPrint       = $fingerPrintFacIns->$fingerPrintethod($fingerPrintParam);


$session = new SessionManaged($sessionInstance, ConfigurationPara::SESSION_TIME);

$controller->setSession($session);
$controller->getSession()->setFingerPrint($fingerPrint);
$controller->getSession()->reload();

$controller->rol();



call_user_func_array([$controller, $methodName], $argumments);

$data = $controller->getData();

if($controller instanceof \Pre\Controller\ApiController){
    ob_clean();
    header("Content-type: application/json; charset=utf-8");
    header("Access-Control-Allow-Origin: *");
    if($data != []) echo json_encode($data);
    exit;
}

$loader  =  new \Twig\Loader\FilesystemLoader("./view");
$twig    =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);

echo $twig->render($foundRoute->getController() . "/" . $foundRoute->getMethod() . ".html", $data);