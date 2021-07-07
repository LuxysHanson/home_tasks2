<?php

namespace app\controllers;

use app\interfaces\IRenderer;

class Controller
{

    private $action = 'index';

    private $layout = 'index';
    private $useLayout = true;

    private $_render = null;
    private $_request = null;

    public function __construct(IRenderer $renderer)
    {
        $this->_render = $renderer;
        $this->_render->setController(get_called_class());
    }

    public function actionIndex() {
        echo $this->render('index');
    }

    public function runAction($action) {
        $this->action = $action ?? $this->action;
        $method = 'action' . ucfirst($this->action);
        if (!method_exists($this, $method)) {
            die("Экшен не существует!");
        }

        call_user_func([$this, $method]);
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function getRequest()
    {
        return $this->_request;
    }

    public function setRequest($request)
    {
        $this->_request = $request;
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->_render->renderTemplate("layouts/{$this->layout}", [
                'header' => $this->_render->renderTemplate('header', $params, true),
                'menu' => $this->_render->renderTemplate('menu', $params, true),
                'content' => $this->_render->renderTemplate($template, $params)
            ], true);
        } else {
            return $this->_render->renderTemplate($template, $params);
        }
    }

}