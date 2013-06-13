<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Http;

class Get {

    // Method : Check if a GET variable exists
    public static function exists($key) {
        return isset($_GET[$key]);
    }

    // Method : Get a GET variable
    public static function get($key) {
        return self::exists($key) ? $_GET[$key] : null;
    }
}
?>
