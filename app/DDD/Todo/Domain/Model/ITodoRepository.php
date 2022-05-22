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
}
