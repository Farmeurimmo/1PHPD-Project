<?php
function autoload($class) {
    $classFile = 'controllers/' . $class . '.php';
    if (file_exists($classFile)) {
        include $classFile;
    }
}

spl_autoload_register('autoload');