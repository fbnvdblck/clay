<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Core;

use Clay\Http\Request;
use Clay\Http\Response;

abstract class Application {

    // Constants
    const ENV_PROD = "production";
    const ENV_DEV = "developpment";

    // Attributes
    private $request;
    private $response;
    private $name;
    private $environment;


    // Constructor
    public function __construct($name, $environment = self::ENV_PROD) {
        $this->request = new Request();
        $this->response = new Response();
        $this->name = $name;
        $this->environment = $environment;
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

    public function getEnvironment() {
        return $this->environment;
    }

    // Method : Run application
    public abstract function run();

    // Method : Get default string value
    public function __toString() {
        return $this->name;
    }

    // Method : Return error 404
    public function error404() {
        header('HTTP/1.1 404 Not Found');
        echo "Not page found";
        exit;
    }
}
?>
