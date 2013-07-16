<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Routing;

use Clay\Clay;
use Clay\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Yaml\Parser;

class Router {

    // Attributes
    private $routes;


    // Constructor
    public function __construct() {
        $this->routes = array();
    }

    // Method : Add route
    public function addRoute(Route $route) {
        if (!in_array($route, $this->routes))
            $this->routes[] = $route;
    }

    // Method : Get route
    public function getRoute($url) {
        foreach ($this->routes as $route) {
            if (($values = $route->match($url)) != false) {
                if ($route->hasParameters()) {
                    $argsName = $route->getParameters();
                    $args = array();

                    for ($i = 0; $i < count($argsName); $i++)
                        $args[$argsName[$i]] = $values[$i+1];

                    $route->setParameters($args);
                }

                return $route;
            }
        }

        throw new RouteNotFoundException("No route for the specified URL: " . $url);
    }

    // Method : Load routes
    public function load() {
        $file =  '../' . Clay::CONFIG_ROUTING;
        $parser = new Parser();

        try {
            $configuration = $parser->parse(file_get_contents($file));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }

        foreach($configuration['routes'] as $route) {
            if (!isset($route['parameters']))
                $route['parameters'] = array();

            $this->addRoute(new Route($route['name'], $route['url'], $route['controller'], $route['action'], $route['parameters']));
        }
    }
}
?>
