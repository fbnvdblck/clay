<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Http;

class Cookie {

    // Method : Check if a cookie exists
    public static function exists($key) {
        return isset($_COOKIE[$key]);
    }

    // Method : Get a cookie
    public static function get($key) {
        return self::exists($key) ? $_COOKIE[$key] : null;
    }

    // Method : Set a cookie
    public static function set($key, $value, $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
        setcookie($key, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
?>
