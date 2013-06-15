<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Application;

abstract class ApplicationComponent {

    // Attributes
    private $app;


    // Constructor
    public function __construct(Application $app) {
        $this->app = $app;
    }

    // Methods : Encapsulation
    // Getters
    public function getApp() {
        return $this->app;
    }
}
?>
