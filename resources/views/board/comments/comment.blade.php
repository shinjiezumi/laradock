@foreach($board->comments as $comment)
    <div class="p-comment__item">
        <p>{!! nl2br(e($comment->comment)) !!}</p>
        <div class="p-comment__bottomLine">
            <span>{{$comment->name}}</span>
            <span>{{$comment->created_at}}</span>
            <form action="{{ action('CommentController@destroy', ['id' => $board->id, 'comment_id' => $comment->id]) }}"
                  method="post"
                  style="display:inline">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-outline-dark" value="削除"/>
            </form>
        </div>
    </div>
@endforeach
