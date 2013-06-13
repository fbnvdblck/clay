<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Http;

class Response {

    // Attributes
    private $page;

    
    // Method : Get page
    public function getPage() {
        return $page;
    }
    
    // Method : Set page
    public function setPage($page) {
        $this->page = $page;
    }

    // Method : Add header
    public function addHeader($header) {
        header($header);
    }

    // Method : Redirect
    public function redirect($location) {
        header('Location: ' . $location);
    }

    public function send() {
    }

    public function setCookie($key, $value, $exire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
        Cookie::set($key, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
?>
