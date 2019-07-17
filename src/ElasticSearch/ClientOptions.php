<?php
namespace App\ElasticSearch;

class ClientOptions
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $index;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|int
     */
    private $id;

    /**
     * @var array
     */
    private $body = [];

    /**
     * @param string $value
     * @return ClientOptions
     */
    public function setHost(string $value)
    {
        $this->host = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $value
     * @return ClientOptions
     */
    public function setIndex(string $value)
    {
        $this->index = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @param string $value
     * @return ClientOptions
     */
    public function setType(string $value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|int $id
     * @return ClientOptions
     */
    public function setId($id)
    {
        if (is_string($id) || is_numeric($id)) {
            $this->id = $id;
        }

        return $this;
    }

    /**
     * @return string|int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $body
     * @return ClientOptions
     */
    public function setBody(array $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param string $key 
     * @param mixed $value
     * @return ClientOptions
     */
    public function addField(string $key, mixed $value)
    {
        $this->body[$key] = $value;
        return $this;
    }
}
