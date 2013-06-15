<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Routing;

class Route {

    // Attributes
    private $name;
    private $url;
    private $controller;
    private $action;
    private $parameters;


    // Constructor
    public function __construct($name, $url, $controller, $action, $parameters) {
        $this->setName($name);
        $this->setUrl($url);
        $this->setController($controller);
        $this->setAction($action);
        $this->setParameters($parameters);
    }

    // Methods : Encapsulation
    // Getters
    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getParameters() {
        return $this->parameters;
    }

    public function hasParameters() {
        return !empty($this->parameters);
    }

    public function hasParameter($name) {
        return isset($this->parameters[$name]);
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function addParameter($name, $value) {
        $this->parameters[$name] = $value;
    }

    // Method : Match a URL and return parameters values
    public function match($url) {
        if (preg_match('^' . $this->url . '$', $url, $args))
            return $args;
        else
            return false;
    }

    // Method : Get default string value
    public function __toString() {
        return $this->name;
    }
}
?>
