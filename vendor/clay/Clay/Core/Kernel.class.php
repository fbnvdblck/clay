<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Core;

use Clay\Clay;
use Clay\Routing\Router;
use Clay\Routing\Exception\RouteNotFoundException;
use Clay\Controller\ControllerHandler;
use Clay\Http\Response;
use Clay\Http\Exception\PageNotFoundException;
use Clay\Controller\Exception\ControllerActionNotFoundException;
use Clay\Controller\Exception\ControllerNotFoundException;

class Kernel extends ApplicationComponent {

    // Attributes
    private $router;
    private $twig;


    // Constructor
    public function __construct(Application $app) {
        parent::__construct($app);
        $this->router = new Router();

        $twigLoader = new \Twig_Loader_Filesystem('../' . Clay::RESOURCE_VIEW);
        $this->twig = new \Twig_Environment($twigLoader, array('cache' => '../' . Clay::RESOURCE_CACHE));
    }

    // Methods : Encapsulation
    // Getters
    public function getRouter() {
        return $this->router;
    }

    public function getTwig() {
        return $this->twig;
    }

    // Method : Execute
    public function execute() {
        // Router loading
        $this->router->load();

        // Request & response
        $request = $this->getApp()->getRequest();
        
        // Route
        try {
            $route = $this->router->getRoute($request->getURI());
        } catch (RouteNotFoundException $e) {
            throw new PageNotFoundException($e->getMessage());
        }

        // Page
        try {
            $page = ControllerHandler::call($route->getController(), $route->getAction(), $route->getParameters(), $this);
            $this->getApp()->getResponse()->setPage($page);
        } catch(ControllerNotFoundException $e) {
            throw new PageNotFoundException();
        } catch(ControllerActionNotFoundException $e) {
            throw new PageNotFoundException();
        }
    }
}
?>
