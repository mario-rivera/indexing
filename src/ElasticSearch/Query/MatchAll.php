<?php
namespace App\ElasticSearch\Query;

class MatchAll implements QueryInterface
{
    /**
     * @return array
     */
    public function getDSL(): array
    {
        return [
            'match_all' => new \stdClass
        ];        
    }
}
