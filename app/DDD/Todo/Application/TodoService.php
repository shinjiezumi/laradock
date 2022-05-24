<?php

namespace App\DDD\Todo\Application;

use App\DDD\Todo\Domain\Model\ITodoRepository;

/**
 *
 */
class TodoService implements ITodoService
{
    /**
     * @var int 1ページ辺りのTodo表示数
     */
    private const TODO_PER_PAGE = 5;

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
        return $todos->paginate(self::TODO_PER_PAGE, ['*'], 'page', $command->getPage());
    }
}
