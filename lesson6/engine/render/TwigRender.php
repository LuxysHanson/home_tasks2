<?php

namespace app\engine\render;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig_Extension_Debug;

class TwigRender extends Render
{
    protected $twig = null;

    public function __construct()
    {
        $loader = new FilesystemLoader($this->getViewsPath());
        $this->twig = new Environment($loader, array('debug' => true));
        $this->twig->addExtension(new Twig_Extension_Debug());
    }

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
        $templatePath = $this->getTemplatePath('', $template, $isLayout);
        return $this->twig->render($templatePath, $params);
    }

}