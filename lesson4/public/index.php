<?php

use app\engine\Autoload;
use app\models\Product;

include __DIR__ . '/../config/constants.php';
include __DIR__ . '/../engine/Autoload.php';

(new Autoload())->run();

// lesson 4

/*$productNew = Product::getOne(2);
$productNew->description = "Описание 123";
$productNew->update();*/

$controllerName = $_GET['c'] ?: BASE_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    return (new $controllerClass())->runAction($actionName);
}

echo "404";