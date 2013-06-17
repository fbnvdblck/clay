<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

class ClayApplication extends Application {
    
    // Constructor
    public function __construct($name) {
        parent::__construct($name);
    }

    // Method : Run
    public function run() {
        $kernel = new Kernel($this);
        $kernel->execute();
    }
}
?>
