<?php

namespace app\engine\render;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

class TwigRender extends Render
{

    public function getRenderType()
    {
        return '.twig';
    }

    public function getViewsPath()
    {
        return '../twig_views/';
    }

    public function renderTemplate($template, $params = [], $isLayout = false)
    {
        ob_start();
        extract($params);
        $templatePath = $this->getTemplatePath($template, $isLayout);
        if (!file_exists($templatePath)) {
            die("Шаблона {$template} не существует!");
        }

        $loader = new Twig_Loader_Filesystem($templatePath);
        $twig = new Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Twig_Extension_Debug());
        echo $twig->render($template . $this->getRenderType(), $params);
        return ob_get_clean();
    }
}