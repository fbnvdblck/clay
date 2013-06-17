<?php
require '../vendor/clay/autoload.php';
Clay::register();

use Clay\Application\ClayApplication;

$app = new ClayApplication('test');
$app->run();
?>
