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
     * @return \App\DDD\Todo\Infrastructure\MySQL\Todo|null
     */
    public function findById(int $id): ?TodoData
    {
        return TodoData::find($id);
    }

    /**
     * @param Todo $todo
     */
    public function create(Todo $todo)
    {
        $todoData = new TodoData($todo->toArray());
        $todoData->save();
    }

    /**
     * @param Todo $todo
     */
    public function update(Todo $todo)
    {
        $todoData = TodoData::find($todo->getId());
        $todoData->fill($todo->toArray());
        $todoData->save();
    }
}
