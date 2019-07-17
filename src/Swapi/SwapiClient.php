<?php
namespace App\Swapi;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SwapiClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    public function __construct(
        Client $client,
        RequestBuilder $requestBuilder
    ){
        $this->client = $client;
        $this->requestBuilder = $requestBuilder;
    }

    public function getPlanet(int $number = 1)
    {
        $request = $this->requestBuilder->getPlanetRequest($number);
        $contents = $this->send($request);

        return $contents;
    }

    /**
     * @param RequestInterface $request
     * @throws RequestException
     * 
     * @return string
     */
    private function send(RequestInterface $request)
    {
        try{
            $response = $this->client->send($request);
        }catch(GuzzleException $e){
            $response = $e->hasResponse() ? $e->getResponse() : null;

            // $exception = new RequestException($e->getMessage(), $request, $response, $e);
            // throw $exception;
            echo "GUZZLE_EXCEPTION " . $e->getMessage() . PHP_EOL;
            return;
        }

        return $response->getBody()->getContents();
    }
}
