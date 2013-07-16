<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Controller;

use Clay\Core\Kernel;
use Clay\Clay;

abstract class Controller {

	// Attributes
	private $kernel;
	private $router;
	private $twig;


	// Constructor
	public function __construct(Kernel $kernel = null) {
		if ($kernel != null) {
			$this->kernel = $kernel;
			$this->router = $kernel->getRouter();
		}
	}

	// Methods : Encapsulation
	// Getters
	public function getRouter() {
		return $this->kernel->getRouter();
	}
}
?>