<?php
require dirname(__DIR__, 1) . '/vendor/autoload.php';

$definitions = __DIR__ . '/definitions.php';
$container = (new \DI\ContainerBuilder())->addDefinitions($definitions)->build();

return $container;
