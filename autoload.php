<?php

function autoloader($className) {
    $path = "classes/{$className}.php";
    if (file_exists($path)) {
        include_once $path;
    } else {
        throw new Exception("Le fichier {$className} n'existe pas");
    }
}

spl_autoload_register("autoloader");