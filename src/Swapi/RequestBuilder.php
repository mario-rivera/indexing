<?php
namespace App\Swapi;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request;

use App\Schema\Swapi;

class RequestBuilder
{
    use \App\Http\RequestBuilderTrait;

    /**
     * @return RequestInterface
     */
    public function getPlanetRequest(int $number): RequestInterface
    {
        $uri = $this->composeUri(Swapi::BASE_URL, Swapi::PLANETS_ENDPOINT, $number);
        return new Request('GET', $uri);
    }
}
