<?php

namespace App\DDD\Todo\Domain\Model;

use App\DDD\Todo\Infrastructure\MySQL\Todo as TodoData;


class Todo
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $body;

    /**
     * @var
     */
    private $limit;

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * @param TodoTitle $title
     * @param TodoBody $body
     * @param TodoLimit $limit
     * @return Todo
     */
    public static function construct(TodoTitle $title, TodoBody $body, TodoLimit $limit): Todo
    {
        $todo = new Todo();
        $todo->updateTitle($title);
        $todo->updateBody($body);
        $todo->updateLimit($limit);

        return $todo;
    }

    /**
     * @param TodoData $todoData
     * @return Todo
     */
    public static function constructFromDataModel(TodoData $todoData): Todo
    {
        $todo = new Todo();
        $todo->id = $todoData->id;
        $todo->title = $todoData->title;
        $todo->body = $todoData->body;
        $todo->limit = $todoData->limit;

        return $todo;
    }

    /**
     * @param TodoTitle $title
     * @return void
     */
    public function updateTitle(TodoTitle $title)
    {
        $this->title = $title;
    }

    /**
     * @param TodoBody $body
     * @return void
     */
    public function updateBody(TodoBody $body)
    {
        $this->body = $body;
    }

    /**
     * @param TodoLimit $limit
     * @return void
     */
    public function updateLimit(TodoLimit $limit)
    {
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
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title->toString(),
            'body' => $this->body->toString(),
            'limit' => $this->limit->toString(),
        ];
    }
}
