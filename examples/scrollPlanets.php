<?php
$container = require_once dirname(__DIR__, 1) . '/config/container.php';

$planetService = $container->get(\App\Planets\PlanetService::class);

$planets = $planetService->getPlanets();

var_dump($planets);