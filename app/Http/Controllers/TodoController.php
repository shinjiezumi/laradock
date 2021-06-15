<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * トップページを表示する
     *
     * @return Factory|View
     */
    public function index()
    {
        $todos = Todo::orderBy('limit', 'asc')->paginate(self::TODO_PER_PAGE);
        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Todo追加ページを表示する
     *
     * @return Factory|View
     */
    public function add()
    {
        return view('todo.add');
    }

    /**
     * Todoを追加する
     *
     * @param TodoRequest $request
     * @return RedirectResponse
     */
    public function post_add(TodoRequest $request)
    {
        $todo = new Todo();
        $todo->fill($request->all())->save();
        return redirect()->route('top');
    }

    /**
     * Todo編集ページを表示する
     *
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $todo = Todo::find(['id' => $request->id])->first();
        return view('todo.edit', ['todo' => $todo]);
    }

    /**
     * Todoを編集する
     *
     * @param TodoRequest $request
     * @return RedirectResponse
     */
    public function post_edit(TodoRequest $request)
    {
        $todo = Todo::find($request->id);
        $todo->fill($request->all())->save();
        return redirect()->route('top');
    }

    /**
     * Todo削除ページを表示する
     *
     * @param Request $request
     * @return Factory|View
     */
    public function delete(Request $request)
    {
        $todo = Todo::find($request->id);
        return view('todo.delete', ['todo' => $todo]);
    }

    /**
     * Todoを削除する
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function post_delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect()->route('top');
    }
}
