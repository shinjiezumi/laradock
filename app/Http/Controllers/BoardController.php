<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\BoardRequest;
use App\Tag;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Log;
use Mockery\Exception;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $boards = DB::table('boards')->paginate(10);
        return view('board.index', ['boards' => $boards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $tags = Tag::all();
        return view('board.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BoardRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function store(BoardRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $tags = $data['tags'] ?? [];
            unset($data['tags']);

            $board = new Board;
            $board->fill($data)->save();
            $board->tags()->sync($tags);
            DB::commit();

            return redirect(route('boards.index'))->with('flash_message', '投稿が完了しました');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $boardId
     * @return Factory|View
     */
    public function show(int $boardId)
    {
        $board = Board::find($boardId);
        return view('board.show', ['board' => $board]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $boardId
     * @return Factory|View
     */
    public function edit(int $boardId)
    {
        $board = Board::find($boardId);
        $tags = Tag::all();
        $currentTags = $board->tags->pluck('id')->all();
        return view('board.edit', ['board' => $board, 'tags' => $tags, 'currentTags' => $currentTags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BoardRequest $request
     * @param int $boardId
     * @return void
     * @throws \Exception
     */
    public function update(BoardRequest $request, int $boardId)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $tags = $data['tags'];
            unset($data['tags']);

            $board = Board::find($boardId);
            $board->fill($data)->save();
            $board->tags()->sync($tags);
            DB::commit();

            return redirect(route('boards.show', ['board' => $boardId]))->with('flash_message', '投稿を更新しました');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $boardId
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $boardId)
    {
        Board::find($boardId)->delete();
        return redirect(route('boards.index'))->with('flash_message', '投稿を削除しました');
    }

}
