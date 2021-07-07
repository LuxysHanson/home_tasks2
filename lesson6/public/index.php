<?php

use app\engine\Autoload;
use app\engine\render\SimpleRender;
use app\engine\Request;

include __DIR__ . '/../config/constants.php';
include __DIR__ . '/../engine/Autoload.php';
include __DIR__ . '/../vendor/autoload.php';

(new Autoload())->run();

$request = new Request();

$controllerName = $request->getControllerName();
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controllerName = new $controllerClass(new SimpleRender());
    $controllerName->setRequest($request);
    return $controllerName->runAction($actionName);
}

echo "404";