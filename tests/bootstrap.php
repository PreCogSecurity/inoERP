<?php
/**
 * PHPUnit bootstrap file for inoERP
 * 
 * This file is auto-loaded by PHPUnit before running tests.
 * It sets up the autoloading for the application classes.
 */

// Autoload composer packages
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap the inoERP application class loading
// PSR-4 autoloading: "InoERP\\": "inoerp/"
spl_autoload_register(function ($class) {
    $prefix = 'InoERP\\';
    $base_dir = __DIR__ . '/../inoerp/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});