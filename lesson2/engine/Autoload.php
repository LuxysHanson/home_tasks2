<?php

namespace app\engine;

class Autoload
{

    protected $alias = 'app\\';

    protected function load($className)
    {
        $classFile = __DIR__ . str_ireplace($this->alias, '/../', $className) . '.php';
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