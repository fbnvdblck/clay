<?php
require '../vendor/clay/autoload.php';
Clay::register();

use Clay\Core\ClayApplication;
use Clay\Core\Application;
use Clay\Logging\Logger;

$app = new ClayApplication('test');
$app->run();
?>
