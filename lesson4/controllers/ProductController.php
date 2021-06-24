<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends BaseController
{

    public function actionCatalog()
    {
        $catalog = Product::getAll();
        $page = $_GET['page'] ?? 1;
        // $catalog = Product::getLimit(($page + 1) * 2);

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