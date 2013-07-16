<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Controller;

use Clay\Clay;
use Clay\Core\Kernel;
use Clay\Controller\Exception\ControllerNotFoundException;
use Clay\Controller\Exception\ControllerActionNotFoundException;

class ControllerHandler {

	// Method : Call a controller by name
	public static function call($controllerName, $actionName, $parameters, Kernel $kernel) {
		$controllerName = $controllerName . 'Controller';
		$actionName = $actionName . 'Action';

		if (file_exists('../' . Clay::RESOURCE_CONTROLLER . $controllerName . '.class.php')) {
			include_once('../' . Clay::RESOURCE_CONTROLLER . $controllerName . '.class.php');
			if (class_exists($controllerName)) {
				$controller = new $controllerName($kernel);

				if (method_exists($controller, $actionName)) {
					if ($parameters != null)
						return $controller->$actionName($parameters);
					else
						return $controller->$actionName();
				}

				else
					throw new ControllerActionNotFoundException("The method of " . $controllerName . " called " . $actionName . " doesn't exist");
			}

			else
				throw new ControllerNotFoundException("The controller called " . $controllerName . " doesn't exist");
		}

		else 
			throw new ControllerNotFoundException("The controller called " . $controllerName . " doesn't exist");
	}
}
?>