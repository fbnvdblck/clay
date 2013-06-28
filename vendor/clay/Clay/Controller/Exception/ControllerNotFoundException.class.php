<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Controller\Exception;

class ControllerNotFoundException extends \Exception {

	// Constructor
	public function __construct($message = '', $code = 0, Exception $previous) {
		parent::__construct($message, $code, $previous);
	}
}
?>