<?php

use app\models\products\Digital;
use app\models\products\Gravimetric;
use app\models\products\Piece;

require __DIR__ . '/../autoload.php';

$piece = new Piece(50);
$piece->calculationOfCost(10);
$piece->getInfo();
$piece->info();

$digital = new Digital(50);
$digital->calculationOfCost(10);
$digital->getInfo();
$digital->info();

$gravimetric = new Gravimetric(50);
$gravimetric->calculationOfCost(1100);
$gravimetric->getInfo();
$gravimetric->info();
//var_dump();