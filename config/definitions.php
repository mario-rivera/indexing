<?php
use Psr\Container\ContainerInterface;

return [
    \App\ElasticSearch\ElasticClientInterface::class => 
        \DI\autowire(\App\ElasticSearch\ElasticClient::class),
];
