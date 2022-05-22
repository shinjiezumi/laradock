<?php

namespace App\DDD\Todo\Infrastructure\MySQL;

use App\DDD\Todo\Domain\Model\ITodoRepository;

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
        return Todo::orderBy('limit', 'asc');
    }
}
