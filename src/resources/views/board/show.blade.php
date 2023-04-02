@extends('layouts.app')

@section('title', '掲示板詳細|Laradock')

@section('content')
  <main class="container">
    <div class="d-flex align-items-center mt-4 mb-4">
      <div class="ml-auto boards__linkBox">
        <a class="btn btn-outline-dark" href="{{route('boards.index')}}">一覧</a>
        <a class="btn btn-outline-dark" href="{{route('boards.edit', ['board' => $board->id])}}">編集</a>
      </div>
    </div>

    @if (session('flash_message'))
      <div class="alert alert-success">
        {{session('flash_message')}}
      </div>
    @endif

    <div class="card">
      <div class="card-header bg-secondary text-white">
        <h4>{{$board->title}}</h4>
        @foreach($board->tags as $tag)
          <span class="badge badge-light">{{$tag->name}}</span>
        @endforeach
      </div>
      <div class="card-body">
        <p class="card-text">{!! nl2br(e($board->body)) !!}</p>
        <p class="text-right font-weight-bold mr-10">{{$board->name}}</p>
      </div>
    </div>

    <div class="p-comment__list">
      <div class="p-comment_listTitle">コメント</div>
      @include('board.comments.comment')
    </div>

    @include('board.comments.form')
  </main>
@endsection
