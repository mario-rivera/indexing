<?php
namespace App\ElasticSearch;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request;

class RequestBuilder
{
    use \App\Http\RequestBuilderTrait;

    public function getIndexRequest(ClientOptions $options): RequestInterface
    {
        $uri = $this->composeUri(
            $options->getHost(), 
            $options->getIndex(), 
            $options->getType(), 
            $options->getId()
        );

        $request = new Request('PUT', $uri, ['Content-Type' => 'application/json'], 
            \GuzzleHttp\json_encode($options->getBody())
        );

        return $request;
    }

    public function getSearchRequest(ClientOptions $options): RequestInterface
    {
        $uri = $this->composeUri(
            $options->getHost(), 
            $options->getIndex(), 
            $options->getType(), 
            '_search'
        );

        $request = new Request('GET', $uri, ['Content-Type' => 'application/json'], 
            \GuzzleHttp\json_encode($options->getQuery())
        );

        return $request;
    }

    public function getScrollRequest(ClientOptions $options, $scrollId)
    {
        if(is_null($scrollId)){

            $uri = $this->composeUri(
                $options->getHost(), 
                $options->getIndex(), 
                $options->getType(), 
                '_search'
            );

            $payload = \GuzzleHttp\json_encode($options->getQuery());

        } else {

            $uri = $this->composeUri(
                $options->getHost(),
                '_search',
                'scroll'
            );

            $payload = $scrollId;
        }

        $uri = $uri->withQuery('scroll=2m');

        $request = new Request('GET', $uri, ['Content-Type' => 'application/json'], 
            $payload
        );

        return $request;
    }
}
