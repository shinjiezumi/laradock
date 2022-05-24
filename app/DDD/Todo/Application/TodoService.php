<?php

namespace App\DDD\Todo\Application;

use App\DDD\Todo\Domain\Model\ITodoRepository;

/**
 *
 */
class TodoService implements ITodoService
{
    /**
     * @var ITodoRepository
     */
    private $todoRepository;

    /**
     * @param ITodoRepository $todoRepository
     */
    public function __construct(ITodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @param TodoGetCommand $command
     * @return void
     */
    public function get(TodoGetCommand $command)
    {
        $todos = $this->todoRepository->find();
        return $todos->paginate($command->getPage());
    }
}
