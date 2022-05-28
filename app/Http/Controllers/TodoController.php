<?php

namespace App\Http\Controllers;

use App\DDD\Todo\Application\ITodoService;
use App\DDD\Todo\Application\TodoGetCommand;
use App\DDD\Todo\Application\TodoStoreCommand;
use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * @var int 1ページ辺りのTodo表示数
     */
    private const TODO_PER_PAGE = 5;

    /**
     * @var ITodoService
     */
    private $todoService;

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
//        $todos = Todo::orderBy('limit', 'asc')->paginate(self::TODO_PER_PAGE);

        $command = new TodoGetCommand($request->get('page', 1));
        $todos = $this->todoService->get($command);

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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
//        $data = $request->validated();
//
//        $todo = new Todo();
//        $todo->fill($data)->save();

        $title = $request->get('title');
        $body = $request->get('body');
        $limit = $request->get('limit');
        $command = new TodoStoreCommand($title, $body, $limit);

        $errors = $this->todoService->store($command);
        if (count($errors) !== 0) {
            throw ValidationException::withMessages($errors);
        }

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
        $todo = Todo::find($todoId);
        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Todoを更新する
     *
     * @param TodoRequest $request
     * @param int $todoId
     * @return RedirectResponse
     */
    public function update(TodoRequest $request, int $todoId): RedirectResponse
    {
        $data = $request->validated();

        $todo = Todo::find($todoId);
        $todo->fill($data)->save();
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
        Todo::find($todoId)->delete();
        return redirect()->route('todos.index')->with('flash_message', 'Todoを削除しました');
    }
}
