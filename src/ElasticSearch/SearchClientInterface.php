<?php
namespace App\ElasticSearch;

interface SearchClientInterface
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
}
