<?php
namespace App\ElasticSearch\Query;

class QueryBuilder
{
    private $queries = [];

    /**
     * @param QueryInterface|array $query
     * @return QueryBuilder
     */
    public function addQuery($query)
    {
        if (!$query instanceof QueryInterface && !is_array($query)) {
            throw new \InvalidArgumentException();
        }

        $this->queries[] = ($query instanceof QueryInterface) ? $query->getDSL() : $query;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        $query = array_reduce($this->queries, function($carry, $item){
            return array_merge($carry, $item);
        }, []);

        return ['query' => $query];
    }
}
