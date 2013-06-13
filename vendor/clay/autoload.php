<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

// Function : Load a class
function autoload($class) {
    require_once str_replace('\\', '/', $class) . '.class.php';
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
