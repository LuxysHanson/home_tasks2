<?php

namespace app\engine\render;

use app\interfaces\IRenderer;

abstract class Render implements IRenderer
{

    abstract public function getRenderType();
    abstract public function getViewsPath();

    protected $controller = null;

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function renderTemplate($template, $params = [], $isLayout = false)
    {
        ob_start();
        extract($params);
        $path = $this->getViewsPath();
        $templatePath = $this->getTemplatePath($path, $template, $isLayout);
        if (!file_exists($templatePath)) {
            die("Шаблона {$template} не существует!");
        }

        include $templatePath;
        return ob_get_clean();
    }

    protected function getControllerName(): string
    {
        $controllerPath = explode(BACKSLASH, $this->getController());
        if (isset($controllerPath[2])) {
            $search = str_ireplace(substr($controllerPath[2], -10, 10), ' ', $controllerPath[2]);
            $name = mb_strtolower(rtrim($search));
            return $name != BASE_CONTROLLER ? $name : '';
        }
        return "";
    }

    protected function getTemplatePath($basePath, $template, $isLayout)
    {
        $path = $basePath;
        $controllerName = $this->getControllerName();
        if (!$isLayout && !empty($controllerName)) {
            $path .= $controllerName . DS;
        }
        return $path . $template . $this->getRenderType();
    }

}