<?php

namespace App\Http\Controllers;

use App\DDD\Exceptions\ResourceNotFoundException;
use App\DDD\Todo\Application\ITodoService;
use App\DDD\Todo\Application\TodoDeleteCommand;
use App\DDD\Todo\Application\TodoGetCommand;
use App\DDD\Todo\Application\TodoGetListCommand;
use App\DDD\Todo\Application\TodoStoreCommand;
use App\DDD\Todo\Application\TodoUpdateCommand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * @var ITodoService
     */
    private $todoService;

    /**
     * @param ITodoService $todoService
     */
    public function __construct(ITodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Todo一覧ページを表示する
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $command = new TodoGetListCommand($request->get('page', 1));
        $todos = $this->todoService->getList($command);

        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Todo作成ページを作成する
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Todoを作成する
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $title = $request->get('title',) ?? '';
        $body = $request->get('body',) ?? '';
        $limit = $request->get('limit',) ?? '';
        $command = new TodoStoreCommand($title, $body, $limit);

        $this->todoService->store($command);

        return redirect()->route('todos.index')->with('flash_message', 'Todoを作成しました');
    }

    /**
     * Todo更新ページを表示する
     *
     * @param int $todoId
     * @return Factory|View
     */
    public function edit(int $todoId)
    {
        $command = new TodoGetCommand($todoId);

        try {
            $todo = $this->todoService->get($command);
        } catch (ResourceNotFoundException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Todoを更新する
     *
     * @param Request $request
     * @param int $todoId
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $todoId): RedirectResponse
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $limit = $request->get('limit');
        $command = new TodoUpdateCommand($todoId, $title, $body, $limit);

        try {
            $this->todoService->update($command);
        } catch (ResourceNotFoundException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return redirect()->route('todos.index')->with('flash_message', 'Todoを更新しました');
    }

    /**
     * Todoを削除する
     *
     * @param int $todoId
     * @return RedirectResponse
     */
    public function destroy(int $todoId): RedirectResponse
    {
        $command = new TodoDeleteCommand($todoId);

        try {
            $this->todoService->delete($command);
        } catch (ResourceNotFoundException $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return redirect()->route('todos.index')->with('flash_message', 'Todoを削除しました');
    }
}
