<?php
$container = require_once dirname(__DIR__, 1) . '/config/container.php';

$client = $container->get(\App\Swapi\SwapiClient::class);
$planetService = $container->get(\App\Planets\PlanetService::class);

$added = 0;
for($i=1; $i<=100; $i++){

    if($result = $client->getPlanet($i)){
        $planetService->addPlanet($i, json_decode($result, true));
        echo "Added " . ++$added . " planet" . PHP_EOL;
    }

    sleep(1);
}
