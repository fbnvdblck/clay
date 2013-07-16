<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Http\Exception;

class PageNotFoundException extends \Exception {

	// Constructor
	public function __construct($message = 'Page not found', $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}
?>