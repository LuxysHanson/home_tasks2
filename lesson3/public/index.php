<?php

use app\engine\Autoload;
use app\models\Product;
use app\models\User;

include __DIR__ . '/../config/constants.php';
include __DIR__ . '/../engine/Autoload.php';

(new Autoload())->run();

// lesson 3

$user = new User();
$user->getOne(1);
$user->getAll();

$product = new Product("Пицца","Описание", 125);
$product->insert();
$product->delete();
/*
$productNew = (new Product)->getOne(2);
$productNew->description = "Описание 2";
$productNew->update();
var_dump($productNew);*/