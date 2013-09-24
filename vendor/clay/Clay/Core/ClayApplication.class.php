<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Core;

use Clay\Http\Exception\PageNotFoundException;
use Clay\Logging\Logger;

class ClayApplication extends Application {
    
    // Constructor
    public function __construct($name, $environment = Application::ENV_PROD) {
        parent::__construct($name, $environment);
    }

    // Method : Run
    public function run() {
        $kernel = new Kernel($this);

        try {
            $kernel->execute();
            $this->getResponse()->send();
        } catch(PageNotFoundException $e) {
            Logger::k($e->getMessage());
            $this->error404();
        }
    }
}
?>
