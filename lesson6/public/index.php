<?php

use app\engine\Autoload;
use app\engine\render\SimpleRender;

include __DIR__ . '/../config/constants.php';
include __DIR__ . '/../engine/Autoload.php';
include __DIR__ . '/../vendor/autoload.php';

(new Autoload())->run();


$controllerName = $_GET['c'] ?: BASE_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controllerName = new $controllerClass(new \app\engine\render\TwigRender());
    return $controllerName->runAction($actionName);
}

echo "404";