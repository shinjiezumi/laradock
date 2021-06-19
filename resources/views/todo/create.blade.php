@extends('layouts.app')

@section('title', \App\Helpers\ViewHelper::generateTitle('Todo作成'))

@section('content')
  <main class="container">
    <div class="d-flex align-items-center mt-5">
      <h1>Todo作成</h1>
      <div class="ml-auto boards__linkBox">
        <a class="btn btn-outline-dark" href="{{route('todos.index')}}">Todo一覧</a>
      </div>
    </div>
    @include('common.error_message')
    @include('todo.form')
  </main>
@endsection
