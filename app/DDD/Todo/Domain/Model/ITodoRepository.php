<?php

namespace App\DDD\Todo\Domain\Model;

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
     * @return object
     */
    public function findById(int $id): ?object;

    /**
     * @param Todo $todo
     * @return mixed
     */
    public function save(Todo $todo);
}
