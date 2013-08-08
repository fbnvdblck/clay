<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

use Clay\Controller\Controller;
use Clay\Core\Kernel;

class MoreComplexController extends Controller {

	// Constructor
	public function __construct(Kernel $kernel) {
		parent::__construct($kernel);
	}

	// Page : Hello
	public function helloAction($parameters) {
		return $this->render('hello.html.twig', $parameters);
	}
}
?>