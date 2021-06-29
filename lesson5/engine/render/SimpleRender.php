<?php

namespace app\engine;

use app\engine\render\Render;

class SimpleRender extends Render
{

    public function renderTemplate($template, $params = [], $isLayout = false)
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

}