<?php

namespace App\DDD\Todo\Application;

class TodoStoreCommand
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $limit;

    /**
     * @param string $title
     * @param string $body
     * @param string $limit
     */
    public function __construct(string $title, string $body, string $limit)
    {
        $this->title = $title;
        $this->body = $body;
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getLimit(): string
    {
        return $this->limit;
    }
}
