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
}
