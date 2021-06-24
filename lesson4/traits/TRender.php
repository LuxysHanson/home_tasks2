<?php

namespace app\traits;

trait TRender
{
    private $layout = 'index';
    private $useLayout = true;

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function isUseLayout()
    {
        return $this->useLayout;
    }

    public function setUseLayout($useLayout)
    {
        $this->useLayout = $useLayout;
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', $params, true),
                'content' => $this->renderTemplate($template, $params)
            ], true);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    protected function renderTemplate($template, $params = [], $isLayout = false)
    {
        ob_start();
        extract($params);
        $templatePath = $this->getTemplatePath($template, $isLayout);
        if (!file_exists($templatePath)) {
            die("Шаблона {$template} не существует!");
        }

        include $templatePath;
        return ob_get_clean();
    }

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

    private function getTemplatePath($template, $isLayout)
    {
        $path = VIEWS_DIR;
        $controllerName = $this->getControllerName();
        if (!$isLayout && !empty($controllerName)) {
            $path .= $controllerName . DS;
        }
        return $path . $template . '.php';
    }

}