<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Routing\Exception;

class RouteNotFoundException extends \Exception {

    // Constructor
    public function __construct($message = '', $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>