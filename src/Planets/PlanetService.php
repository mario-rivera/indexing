<?php
namespace App\Planets;

use App\ElasticSearch\ElasticClientInterface;
use App\ElasticSearch\ClientOptions;
use App\ElasticSearch\Query\QueryBuilder;

use App\Schema\Planets;

class PlanetService
{
    /**
     * @var ElasticClientInterface
     */
    private $client;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(
        ElasticClientInterface $client
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

    public function getPlanets()
    {
        $queryBuilder = (new QueryBuilder)
        ->addQuery(new \App\ElasticSearch\Query\MatchAll);

        $options = (new ClientOptions)
        ->setHost($this->getElasticHost())
        ->setIndex(Planets::INDEX)
        ->setType(Planets::TYPE)
        ->setQuery($queryBuilder);

        $result = [];
        $this->client->scroll($options, function($contents) use(&$result){
            $result = array_merge($result, $contents['hits']['hits']);
        });

        return $result;
    }
}
