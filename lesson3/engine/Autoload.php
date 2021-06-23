<?php

namespace app\engine;

class Autoload
{

    protected $alias = 'app' . BACKSLASH;

    protected function load($className)
    {
        $classFile = str_ireplace([$this->alias, BACKSLASH], [ROOT . DS, DS], $className) . '.php';
        if (is_file($classFile) && !file_exists($classFile)) {
            return;
        }

        include $classFile;
    }

    public function run()
    {
        spl_autoload_register(array(static::class, 'load'));
    }

}