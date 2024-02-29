<?php

namespace lightframe;

class AutoLoader
{
    private const DEBUG_NAMESPACES = ['Debug'];

    public static function register() : void
    {
        spl_autoload_register([new self, 'autoload']);
    }

    public function autoload(string $className) : void
    {
        $namespace = explode('\\', $className);

        if ($_ENV['DEBUG'] && in_array($namespace[0], self::DEBUG_NAMESPACES)) {
            return;
        }

        if (isset($namespace[0]) && ($namespace[0] === 'lightframe')) {
            $file = 'Classes' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array_slice($namespace, 1)) . '.php';
        } else {
            $file = 'Vendor' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $namespace) . '.php';
        }

        if (file_exists($file)) {
            require_once($file);
        }
    }
}