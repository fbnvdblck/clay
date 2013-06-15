<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

use Clay\Http\Request;
use Clay\Http\Response;

class Application {

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
    public function run() {
        echo "Kernel call!";
    }

    // Method : Get default string value
    public function __toString() {
        return $this->name;
    }
}
?>
