<?php
use Psr\Container\ContainerInterface;

return [
    \App\ElasticSearch\SearchClientInterface::class => 
        \DI\autowire(\App\ElasticSearch\SearchClient::class),
];
