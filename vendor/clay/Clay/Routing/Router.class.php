<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Routing;

use Clay\Clay;
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
            if (($values = $route->match($url)) !== false) {
                if ($route->hasArguments()) {
                    $argsName = $route->getArguments();
                    $args = array();

                    for ($i = 0; i < count($values); $i++)
                        $args[$argsName[$i]] = $values[$i];

                    $route->setArguments($args);
                }

                return $route;
            }
        }

        throw new \RuntimeException("No route for the specified URL");
    }

    // Method : Load routes
    public function load() {
        $file = __DIR__ . '/' . Clay::CONFIG_ROUTING;
        $parser = new Parser();

        try {
            $configuration = $yaml->parse(file_get_contents($file));
        }

        catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }

        foreach($configuration['routes'] as $route)
            $this->addRoute(new Route($route['name'], $route['url'], $route['controller'], $route['action'], $route['parameters']));
    }
}
?>
