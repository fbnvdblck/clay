<?php
require '../vendor/clay/autoload.php';
Clay::register();

use Clay\Application\Application;

$app = new Application('Elhena');
echo $app->getName();
?>
