<?php

use app\interfaces\IModel;
use app\models\Product;
use app\models\User;
use app\engine\Db;

require __DIR__ . '/../autoload.php';

$product = new Product(new Db());


$product->getOne(15);
//$product->getAll();

$user = new User(new Db());

$user->getOne(2);
$user->getAll();


function foo(IModel $model) {
    $model->getAll();
}

foo($product);
foo($user);

var_dump($product);