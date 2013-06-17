<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

use Clay\Routing\Router;
use Clay\Routing\Exception\RouteNotFoundException;

class Kernel extends ApplicationComponent {

    // Attributes
    private $router;

    // Constructor
    public function __construct(Application $app) {
        parent::__construct($app);
        $this->router = new Router();
    }

    // Method : Execute
    public function execute() {
        $this->router->load();
        $request = $this->getApp()->getRequest();
        
        try {
            $route = $this->router->getRoute($request->getURI());
            echo $route;
        } catch (RouteNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
?>
