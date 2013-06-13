<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Http;

class Post {

    // Method : Check if a POST variable exists
    public static function exists($key) {
        return isset($_POST[$key]);
    }

    // Method : Get a POST variable
    public static function get($key) {
        return self::exists($key) ? $_POST[$key] : null;
    }
}
?>
