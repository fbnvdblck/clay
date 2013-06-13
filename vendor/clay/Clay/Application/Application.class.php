<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

use Clay\Http;

abstract class Application {

    // Attributes
    private $request;
    private $response;
    private $name;


    // Constructor
    public function __construct() {
        $request = new Request();
        $response = new Response();
        $name = '';
    }

    // Methods : Encapsulation
    // Getters
    public function getRequest() {
        return $request;
    }

    public function getResponse() {
        return $response;
    }

    public function getName() {
        return $name;
    }

    // Method : Run application
    public abstract function run();

    // Method : Get default string value
    public function __toString() {
        return $name;
    }
}
?>
