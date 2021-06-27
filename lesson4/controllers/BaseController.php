<?php

namespace app\controllers;

use app\traits\TRender;

class BaseController
{

    use TRender;

    private $action = 'index';

    public function actionIndex() {
        echo $this->render('index');
    }

    public function runAction($action) {
        $this->action = $action ?? $this->action;
        $method = 'action' . ucfirst($this->action);
        if (!method_exists($this, $method)) {
            die("Экшен не существует!");
        }

        $this->$method();
    }

}