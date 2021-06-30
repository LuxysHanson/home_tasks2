<?php

namespace app\engine\render;

class SimpleRender extends Render
{

    public function getRenderType()
    {
        return '.php';
    }

    public function getViewsPath()
    {
        return '../views/';
    }

    public function renderTemplate($template, $params = [], $isLayout = false)
    {
        return parent::renderTemplate($template, $params, $isLayout);
    }
}