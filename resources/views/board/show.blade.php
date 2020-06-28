@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center mt-4 mb-4">
        <div class="ml-auto boards__linkBox">
            <a class="btn btn-outline-dark" href="{{route('boards.index')}}">一覧</a>
            <a class="btn btn-outline-dark" href="{{route('boards.edit', ['id' => $board->id])}}">編集</a>
        </div>
    </div>

    @if (session('flash_message'))
        <div class="alert alert-primary">
            {{session('flash_message')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>{{$board->title}}</h4>
            @foreach($board->tags as $tag)
                <span class="badge badge-primary">{{$tag->name}}</span>
            @endforeach
        </div>
        <div class="card-body">
            <p class="card-text">{{$board->body}}</p>
            <p class="text-right font-weight-bold mr-10">{{$board->author}}</p>
        </div>
    </div>

    {{--<div class="p-comment__list">--}}
    {{--  <div class="p-comment_listTitle">コメント</div>--}}
    {{--  <!--[MEMO] renderの引数に複数のモデルオブジェクトを指定すると、そのモデルのビュー(app/views/comments/_comment.html.erb)が自動的に適用される -->--}}
    {{--  <%= render @board.comments %>--}}
    {{--</div>--}}

    {{--<%= render partial: 'comments/form', locals: {comment: @comment} %>--}}
@endsection
