<?php
namespace App\ElasticSearch\Query;

interface QueryInterface
{
    /**
     * @return array
     */
    public function getDSL(): array;
}
