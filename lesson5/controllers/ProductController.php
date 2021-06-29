<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{

    public function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;
        $catalog = Product::getLimit(($page + 1) * 2);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $good = Product::getOne((int) $_GET['id']);

        if (!$good) {
            die("Нет такого товара");
        }

        echo $this->render('card', [
            'good' => $good
        ]);
    }

}