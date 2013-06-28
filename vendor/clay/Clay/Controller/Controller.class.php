<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Controller;

use Clay\Application\Kernel;

abstract class Controller {

	// Attributes
	private $kernel;
	private $router;
	private $twig;


	// Constructor
	public function __construct(Kernel $kernel) {
		$this->kernel = $kernel;
		$this->router = $kernel->getRouter();
	}

	// Methods : Encapsulation
	// Getters
	public function getRouter() {
		return $this->kernel;
	}
}
?>