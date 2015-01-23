<?php
/**
 * User: Vilius Kukanauskas, mydata GmbH
 * Package: autoloader
 * Date: 09.01.15
 * Time: 08:35
 * @param String $class_name
 */
function myAutoloader($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    $root = '';
    $file = $root . $class_name . '.php';
    if (file_exists($file)) {
        require_once($file);
    }

    else {
        echo '<br>' . $file . ' im namespace nicht gefunden, suche nun danach, das kann dauern  !';
        checkPathForClass('', removeNamespace($class_name));
    }
}


function checkAndLoadIfIsSet($file) {
    if (file_exists($file)) {
        echo '<br>gefunden ! !!!!!!!!!!!!!!!!!!!!:  ' . $file.'!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
        echo '<br> wird implementiert, bitte mit namespace versehen !';
        require_once($file);
    }
}

function giveSubdirToPath($path) {
    return glob($path . '/*', GLOB_ONLYDIR);
}


function checkPathForClass($path, $class_name) {
    $file = $path . 'php' . $class_name . '.php';
    // echo '<br>'.$file;
    checkAndLoadIfIsSet($file);
    foreach (giveSubdirToPath($path) as $dir) {
        checkPathForClass($dir, $class_name);
    }

}


function removeNamespace($file) {
    echo '<br> aus ' . $file;
    $file = substr(strrchr($file, "/"), 1);
    echo ' <-mach->' . $file . ' und suche danach';
    return $file;
}

spl_autoload_register('myAutoloader');