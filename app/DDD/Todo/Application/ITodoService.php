<?php

namespace App\DDD\Todo\Application;

/**
 *
 */
interface ITodoService
{
    public function get(TodoGetCommand $command);
}
