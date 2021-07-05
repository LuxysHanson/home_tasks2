<?php

namespace app\engine\render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig_Extension_Debug;

class TwigRender extends Render
{
    protected static $twig = null;

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
        $twig = $this->getTwig($template, $isLayout);
        return $twig->render($template . $this->getRenderType(), $params);
    }


    protected function getTwig($template, $isLayout)
    {
        if (is_null(static::$twig)) {
            $templatePath = $this->getTemplatePath($template, $isLayout);
            $loader = new FilesystemLoader($templatePath);
            static::$twig = new Environment($loader, array('debug' => true));
            static::$twig->addExtension(new Twig_Extension_Debug());
        }
        return static::$twig;
    }
}