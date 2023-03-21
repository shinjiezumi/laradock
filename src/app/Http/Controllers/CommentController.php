<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @param int $boardId
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CommentRequest $request, int $boardId)
    {
        $data = $request->validated();

        $comment = new Comment;
        $comment->board_id = $boardId;
        $comment->fill($data)->save();
        return redirect(route('boards.show', ['board' => $boardId]))->with('flash_message', 'コメントを投稿しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $boardId
     * @param int $commentId
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $boardId, int $commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        return redirect(route('boards.show', ['board' => $boardId]))->with('flash_message', 'コメントを削除しました');
    }

}
