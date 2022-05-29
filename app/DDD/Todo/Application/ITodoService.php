<?php

namespace App\DDD\Todo\Application;

/**
 *
 */
interface ITodoService
{
    public function getList(TodoGetListCommand $command);

    public function get(TodoGetCommand $command);

    public function store(TodoStoreCommand $command);

    public function update(TodoUpdateCommand $command);
}
