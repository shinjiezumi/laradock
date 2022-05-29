<?php

namespace App\DDD\Todo\Domain\Model;

use App\DDD\Todo\Infrastructure\MySQL\Todo as TodoData;

/**
 *
 */
interface ITodoRepository
{
    /**
     * @return object
     */
    public function find(): object;

    /**
     * @param int $id
     */
    public function findById(int $id): ?TodoData;

    /**
     * @param Todo $todo
     */
    public function create(Todo $todo);

    /**
     * @param Todo $todo
     */
    public function update(Todo $todo);
}
