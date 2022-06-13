<?php

namespace App\DDD\Todo\Application;

use App\DDD\Exceptions\ResourceNotFoundException;
use Illuminate\Validation\ValidationException;

interface ITodoService
{
    /**
     * @param TodoGetListCommand $command
     * @return mixed
     */
    public function getList(TodoGetListCommand $command);

    /**
     * @param TodoGetCommand $command
     * @return object
     * @throws ResourceNotFoundException
     */
    public function get(TodoGetCommand $command): object;

    /**
     * @param TodoStoreCommand $command
     * @return void
     */
    public function store(TodoStoreCommand $command): void;

    /**
     * @param TodoUpdateCommand $command
     * @return void
     * @throws ValidationException
     * @throws ResourceNotFoundException
     */
    public function update(TodoUpdateCommand $command): void;

    /**
     * @param TodoDeleteCommand $command
     * @return void
     * @throws ResourceNotFoundException
     */
    public function delete(TodoDeleteCommand $command): void;
}
