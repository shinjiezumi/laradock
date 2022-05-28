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
     * @param Todo $todo
     * @return mixed
     */
    public function save(Todo $todo);
}
