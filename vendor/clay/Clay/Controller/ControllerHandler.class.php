<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Controller;

use Clay\Application\Kernel;
use Clay\Controller\Exception\ControllerNotFoundException;
use Clay\Controller\Exception\ControllerActionNotFoundException;

class ControllerHandler {

	// Method : Call a controller by name
	public static function call($controllerName, $actionName, Kernel $kernel) {
		$controllerName = $controllerName . 'Controller';
		$actionName = $actionName . 'Action';

		if ((include('../src/controller/' . $controllerName . '.class.php')) == true) {
			if (class_exists($controllerName)) {
				$controller = new $controllerName($kernel);

				if (method_exists($controller, $actionName)) {
					return $controller->$actionName();
				}

				else
					throw new ControllerActionNotFoundException("The method of " . $controllerName . " called " . $actionName . " doesn't exist");
			}

			else
				throw new ControllerNotFoundException("The controller called " . $controllerName . " doesn't exist");
		}

		else 
			throw new ControllerActionNotFoundException("The method of " . $controllerName . " called " . $actionName . " doesn't exist");
	}
}
?>