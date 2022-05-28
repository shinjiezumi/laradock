<?php

namespace App\DDD\Todo\Infrastructure\MySQL;

use App\DDD\Todo\Domain\Model\ITodoRepository;
use App\DDD\Todo\Domain\Model\Todo;
use App\DDD\Todo\Infrastructure\MySQL\Todo as TodoData;

/**
 *
 */
class TodoRepository implements ITodoRepository
{
    /**
     * @return object
     */
    public function find(): object
    {
        return TodoData::orderBy('limit', 'asc');
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function findById(int $id): ?object
    {
        return TodoData::find($id);
    }

    /**
     * @param Todo $todo
     */
    public function save(Todo $todo)
    {
        $todoData = new TodoData($todo->toArray());
        $todoData->save();
    }
}
