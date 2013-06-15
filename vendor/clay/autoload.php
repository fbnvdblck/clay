<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

// Function : Load a class
function autoload($class) {
    require __DIR__ . '/' . str_replace('\\', '/', $class) . '.class.php';
}

class Clay {

    // Constants
    const NAME = 'Clay';
    const VERSION = 0.1;

    // Method : Register autolad
    public static function register() {
        spl_autoload_register('autoload');
    }
}
?>
