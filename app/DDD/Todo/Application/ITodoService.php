<?php

namespace App\DDD\Todo\Application;

/**
 * ITodoService Todoサービスインターフェース
 */
interface ITodoService
{
    /**
     * @param TodoGetListCommand $command
     * @return mixed
     */
    public function getList(TodoGetListCommand $command);

    /**
     * @param TodoGetCommand $command
     * @return mixed
     */
    public function get(TodoGetCommand $command);

    /**
     * @param TodoStoreCommand $command
     * @return void
     */
    public function store(TodoStoreCommand $command): void;

    /**
     * @param TodoUpdateCommand $command
     * @return void
     */
    public function update(TodoUpdateCommand $command): void;

    /**
     * @param TodoDeleteCommand $command
     * @return void
     */
    public function delete(TodoDeleteCommand $command): void;
}
