<?php

namespace App\DDD\Todo\Application;

class TodoUpdateCommand
{
    /**
     * @var int
     */
    private $id;

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
     * @param int $id id
     * @param string|null $title タイトル
     * @param string|null $body
     * @param string|null $limit
     */
    public function __construct(int $id, ?string $title, ?string $body, ?string $limit)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
