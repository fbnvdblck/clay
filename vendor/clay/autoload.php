<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

class Clay {

    // Method : Register autolad
    public static function register() {
    	// Clay & components
        spl_autoload_register(array(new self, 'autoloadClay'));
        spl_autoload_register(array(new self, 'autoloadTwig'));
        spl_autoload_register(array(new self, 'autoloadFromModel'));
    }

    // Method : Load a class from Clay
	private static function autoloadClay($class) {
    	@include __DIR__ . '/' . str_replace('\\', '/', $class) . '.class.php';
	}

    // Method : Load a class from Twig
    private static function autoloadTwig($class) {
        @include __DIR__ . '/' . str_replace(array('_', "\0"), array('/', ''), $class).'.php';
    }

	// Method : Load a class from model
	private static function autoloadFromModel($class) {
		require '../src/model/' . str_replace('\\', '/', $class) . '.class.php';
	}
}
?>
