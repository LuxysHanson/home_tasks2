<?php

namespace app\engine\render;

use app\interfaces\IRenderer;

abstract class Render implements IRenderer
{

    protected function getControllerName(): string
    {
        $controllerPath = explode(BACKSLASH, get_called_class());
        if (isset($controllerPath[2])) {
            $search = str_ireplace(substr($controllerPath[2], -10, 10), ' ', $controllerPath[2]);
            $name = mb_strtolower(rtrim($search));
            return $name != BASE_CONTROLLER ? $name : '';
        }
        return "";
    }

    protected function getTemplatePath($template, $isLayout, $renderType = 'php')
    {
        $path = VIEWS_DIR;
        $controllerName = $this->getControllerName();
        if (!$isLayout && !empty($controllerName)) {
            $path .= $controllerName . DS;
        }
        return $path . $template . '.' . $renderType;
    }

}