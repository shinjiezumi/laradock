<?php

namespace App\DDD\Todo\Application;

use App\DDD\Exceptions\ResourceNotFoundException;
use App\DDD\Todo\Domain\Model\ITodoRepository;
use App\DDD\Todo\Domain\Model\Todo;

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
     * @param TodoGetListCommand $command
     * @return mixed
     */
    public function getList(TodoGetListCommand $command)
    {
        $todos = $this->todoRepository->find();
        return $todos->paginate(self::TODO_PER_PAGE, ['*'], 'page', $command->getPage());
    }

    /**
     * @param TodoGetCommand $command
     * @return object
     * @throws ResourceNotFoundException
     */
    public function get(TodoGetCommand $command): object
    {
        $todo = $this->todoRepository->findById($command->getId());
        if ($todo === null) {
            throw new ResourceNotFoundException();
        }

        return $todo;
    }

    /**
     * @param TodoStoreCommand $command
     * @return array|mixed
     */
    public function store(TodoStoreCommand $command)
    {
        list($todo, $errors) = Todo::construct($command->getTitle(), $command->getBody(), $command->getLimit());
        if (count($errors) !== 0) {
            return $errors;
        }

        $this->todoRepository->save($todo);
        return [];
    }
}
