<?php

namespace app\engine\render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig_Extension_Debug;

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
        $templatePath = $this->getTemplatePath($template, $isLayout);
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader, array('debug' => true));
        $twig->addExtension(new Twig_Extension_Debug());
        return $twig->render($template . $this->getRenderType(), $params);
    }
}