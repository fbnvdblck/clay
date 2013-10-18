<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Routing;

use Clay\Clay;
use Clay\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Yaml\Parser;
use Clay\Logging\Logger;

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

    // Method : generate URL
    public function generateUrl($routeName, $parameters) {
        foreach ($this->routes as $route) {
            if ($route->getName() == $routeName) {
                $url = $route->getUrl();

                if ($route->hasParameters()) {

                    if (count($route->getParameters()) == count($parameters)) {
                        $url = preg_replace("/\([^)]*\)/", "%", $url);
                        foreach ($parameters as $parameter)
                            $url = preg_replace("/%/", $parameter, $url, 1);

                        return $url;
                    }

                    else
                        throw new RouteNotFoundException("The parameters passed to build URL are incorrect");
                }

                else {
                    return $url;
                }
            }
        }

        throw new RouteNotFoundException("The route called " . $routeName . " doesn't exist");
    }

    // Method : Load routes
    public function load() {
        $file =  '../' . Clay::CONFIG_ROUTING;
        $parser = new Parser();

        try {
            $configuration = $parser->parse(file_get_contents($file));
        } catch (ParseException $e) {
            Logger::k("Unable to parse the YAML string: %s", $e->getMessage());
        }

        foreach($configuration['routes'] as $route) {
            if (!isset($route['parameters']))
                $route['parameters'] = array();

            $this->addRoute(new Route($route['name'], $route['url'], $route['controller'], $route['action'], $route['parameters']));
        }
    }
}
?>
