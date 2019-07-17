<?php
namespace App\ElasticSearch;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

class ElasticClient implements ElasticClientInterface
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
     * @param ClientOptions $options
     */
    public function search(ClientOptions $options)
    {
        $request = $this->requestBuilder->getSearchRequest($options);
        return $this->send($request);
    }

    /**
     * @param ClientOptions $options
     * @param callable $callback
     * @param string $scrollId
     */
    public function scroll(ClientOptions $options, callable $callback, $scrollId = null)
    {
        $request = $this->requestBuilder->getScrollRequest($options, $scrollId);
        $result = $this->send($request);
        
        call_user_func($callback, $result);
        
        if (!empty($result['hits']['hits']) && !empty($result['_scroll_id'])) {
            $this->scroll($options, $callback, $result['_scroll_id']);
        }
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

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }
}
