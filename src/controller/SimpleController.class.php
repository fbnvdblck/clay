<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

use Clay\Controller\Controller;
use Clay\Core\Kernel;
use Elhena\Person;
use Clay\Logging\Logger;
use Clay\Database\DatabaseConnection;

class SimpleController extends Controller {

	// Constructor
	public function __construct(Kernel $kernel) {
		parent::__construct($kernel);
	}

	// Page : home
	public function homeAction() {
		return "Welcome on your first simple application with Clay Framework!";
	}
}