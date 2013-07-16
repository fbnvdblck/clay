<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

class Clay {

    // Constants
    const NAME = 'Clay';
    const VERSION = 0.1;

    // Method : Register autolad
    public static function register() {

    	// Clay
        spl_autoload_register(array(new self, 'autoload'));
        spl_autoload_register(array(new self, 'autoloadFromModel'));
    }

    // Method : Load a class from clay
	private static function autoload($class) {
    	@include __DIR__ . '/' . str_replace('\\', '/', $class) . '.class.php';
	}

	// Method : Load a class from model
	private static function autoloadFromModel($class) {
		require '../src/model/' . str_replace('\\', '/', $class) . '.class.php';
	}
}
?>
