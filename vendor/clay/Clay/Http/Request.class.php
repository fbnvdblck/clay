<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.Com>
 */

namespace Clay\Http;

class Request {

    // Method : Get a cookie
    public function cookie($key) {
        Cookie::get($key);
    }

    // Method : Get a GET variable
    public function get($key) {
        Get::get($key);
    }

    // Method : Get a POST variable
    public function post($key) {
        Post::get($key);
    }

    // Method : Get the request method
    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Method : Get the request URI
    public function getURI() {
        return $_SERVER['REQUEST_URI'];
    }
}
?>
