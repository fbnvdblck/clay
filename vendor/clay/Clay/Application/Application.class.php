<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

use Clay\Http\Request;
use Clay\Http\Response;

abstract class Application {

    // Attributes
    private $request;
    private $response;
    private $name;


    // Constructor
    public function __construct($name) {
        $this->request = new Request();
        $this->response = new Response();
        $this->name = $name;
    }

    // Methods : Encapsulation
    // Getters
    public function getRequest() {
        return $this->request;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getName() {
        return $this->name;
    }

    // Method : Run application
    public abstract function run();

    // Method : Get default string value
    public function __toString() {
        return $this->name;
    }
}
?>
