<?php
namespace App\ElasticSearch;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

class SearchClient implements SearchClientInterface
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

    /**
     * @param ClientOptions $options
     */
    public function index(ClientOptions $options)
    {
        $request = $this->requestBuilder->getIndexRequest($options);
        return $this->send($request);
    }

    /**
     * @param ClientOptions $options
     */
    public function get(ClientOptions $options)
    {
        throw new \RuntimeException("Method not implemented.");
    }

    /**
     * @param ClientOptions $options
     */
    public function delete(ClientOptions $options)
    {
        throw new \RuntimeException("Method not implemented.");
    }

    /**
     * @param ClientOptions $options
     */
    public function update(ClientOptions $options)
    {
        throw new \RuntimeException("Method not implemented.");
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
