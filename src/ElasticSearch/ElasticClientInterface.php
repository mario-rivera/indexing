<?php
namespace App\ElasticSearch;

interface ElasticClientInterface
{
    /**
     * @param ClientOptions $options
     */
    public function index(ClientOptions $options);

    /**
     * @param ClientOptions $options
     */
    public function get(ClientOptions $options);

    /**
     * @param ClientOptions $options
     */
    public function delete(ClientOptions $options);

    /**
     * @param ClientOptions $options
     */
    public function update(ClientOptions $options);

    /**
     * @param ClientOptions $options
     */
    public function search(ClientOptions $options);

    /**
     * @param ClientOptions $options
     * @param callable $callback
     * @param string $scrollId
     */
    public function scroll(ClientOptions $options, callable $callback, string $scrollId = null);
}
