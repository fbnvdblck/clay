<?php
require '../vendor/clay/autoload.php';
Clay::register();

use Clay\Core\ClayApplication;

$app = new ClayApplication('test');
$app->run();
?>
