<?php
namespace App\Http;

use GuzzleHttp\Psr7\Uri;

trait RequestBuilderTrait
{
    /**
     * @return Uri
     */
    public function composeUri($baseUrl, ...$path): Uri
    {
        $uri = new Uri($baseUrl);
        $path = $this->resolvePath($uri->getPath(), ...$path);

        return $uri->withPath($path);
    }

    /**
     * @return string
     */
    private function resolvePath(...$parts): string
    {
        $input = array_reduce($parts, function($carry, $item){
            $carry = array_merge($carry, explode('/', $item));
            return $carry;
        }, []);

        $output = array_filter($input, function($el){
            return !empty($el);
        });

        return implode('/', $output);
    }
}
