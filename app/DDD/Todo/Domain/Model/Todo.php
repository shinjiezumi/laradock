<?php

namespace App\DDD\Todo\Domain\Model;

use App\DDD\Todo\Infrastructure\MySQL\Todo as TodoData;


/**
 * Todo TODOモデル
 */
class Todo
{
    private $id;
    private $title;
    private $body;
    private $limit;

    private function __construct()
    {
    }

    public static function construct(TodoTitle $title, TodoBody $body, TodoLimit $limit): Todo
    {
        $todo = new Todo();
        $todo->updateTitle($title);
        $todo->updateBody($body);
        $todo->updateLimit($limit);

        return $todo;
    }

    public static function constructFromDataModel(TodoData $todoData): Todo
    {
        $todo = new Todo();
        $todo->id = $todoData->id;
        $todo->title = $todoData->title;
        $todo->body = $todoData->body;
        $todo->limit = $todoData->limit;

        return $todo;
    }

    public function updateTitle(TodoTitle $title)
    {
        $this->title = $title;
    }

    public function updateBody(TodoBody $body)
    {
        $this->body = $body;
    }

    public function updateLimit(TodoLimit $limit)
    {
        $this->limit = $limit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title->toString(),
            'body' => $this->body->toString(),
            'limit' => $this->limit->toString(),
        ];
    }
}
