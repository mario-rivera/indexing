<?php
namespace App\Planets;

use App\ElasticSearch\ClientOptions;
use App\ElasticSearch\SearchClientInterface;
use App\Schema\Planets;

class PlanetService
{
    /**
     * @var SearchClientInterface
     */
    private $client;

    public function __construct(
        SearchClientInterface $client
    ){
        $this->client = $client;    
    }

    public function getElasticHost()
    {
        return getenv('ELASTIC_CONNECT');
    }

    public function addPlanet(int $id, array $body)
    {
        $options = (new ClientOptions)
        ->setHost($this->getElasticHost())
        ->setIndex(Planets::INDEX)
        ->setType(Planets::TYPE)
        ->setId($id)
        ->setBody($body);

        $this->client->index($options);
    }
}
