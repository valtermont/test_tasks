<?php

spl_autoload_register(function ($class) {
    $prefix = 'Test\\';
    $base_dir = __DIR__ . '/components/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $slashPos = strripos($relative_class, "\\");

    $className = substr($relative_class,  $slashPos ? $slashPos + 1 : 0);
    $classFolder = strtolower(substr($relative_class,  0, $slashPos ? $slashPos + 1 : 0));

    $file = $base_dir . str_replace('\\', '/', $classFolder.$className) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});