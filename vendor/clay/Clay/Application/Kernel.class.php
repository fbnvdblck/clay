<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

use Clay\Routing\Router;
use Clay\Routing\Exception\RouteNotFoundException;
use Clay\Controller\ControllerHandler;
use Clay\Http\Response;
use Clay\Controller\Exception\ControllerActionNotFoundException;
use Clay\Controller\Exception\ControllerNotFoundException;

class Kernel extends ApplicationComponent {

    // Attributes
    private $router;


    // Constructor
    public function __construct(Application $app) {
        parent::__construct($app);
        $this->router = new Router();
    }

    // Methods : Encapsulation
    // Getters
    public function getRouter() {
        return $this->router;
    }

    // Method : Execute
    public function execute() {
        // Router loading
        $this->router->load();

        // Request & response
        $request = $this->getApp()->getRequest();
        $response = new Response();
        
        // Route
        try {
            $route = $this->router->getRoute($request->getURI());
        } catch (RouteNotFoundException $e) {
            echo $e->getMessage();
        }

        // Page
        try {
            $page = ControllerHandler::call($route->getController(), $route->getAction(), $this);
            echo $page;
        } catch(ControllerActionNotFoundException $e) {
            echo $e->getMessage();
        }
          catch(ControllerNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
?>
