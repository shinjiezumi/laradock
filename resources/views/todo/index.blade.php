@extends('layouts.app')

@section('title', \App\Helpers\ViewHelper::generateTitle('Todo一覧'))

@section('content')
  {{-- // TODO --}}
  {{-- {{ Breadcrumbs::render('todo') }}--}}
  <main id="todo">
    <div class="container">
      <div class="todoList">
        @if (session('flash_message'))
          <div class="alert alert-success">
            {{session('flash_message')}}
          </div>
        @endif
        <table class="table">
          {{-- ヘッダー --}}
          <thead>
            <tr>
              <th class="col-2" scope="col">期限</th>
              <th class="col-7" scope="col">Todo</th>
              <th class="col-3" scope="col"></th>
            </tr>
          </thead>
          {{-- 一覧 --}}
          <tbody>
            @foreach($todos as $todo)
              <tr>
                <td>{{ $todo->limit->format('Y/m/d') }}</td>
                <td>
                  <div class="todoItem__content">
                    <span class="todoItem__title">{{ $todo->title }}</span>
                  </div>
                  <div id="{{'detail-' . $todo->id}}" class="collapse">
                    {!! nl2br(e($todo->body)) !!}
                  </div>
                </td>
                <td>
                  <div class="todoItem__buttonWrap">
                    <button
                      class="btn btn-outline-dark todoItem__detailButton"
                      data-toggle="collapse"
                      data-target="{{'#detail-' . $todo->id}}"
                    >
                      <i class="fas fa-eye"></i>
                    </button>
                    <div class="todoItem__editLink">
                      <a class="btn btn-outline-dark"
                         href="{{ route('todos.edit', ['todo' => $todo->id]) }}">
                        <i class="fas fa-edit"></i>
                      </a>
                    </div>
                    <div class="todoItem__deleteLink">
                      <form action="{{ action('TodoController@destroy', $todo->id) }}" method="post"
                            style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-dark">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
          @endforeach
        </table>
      </div>
      <div class="todoAddButton">
        <a class="btn btn-outline-dark"
           href="{{ route('todos.create') }}">
          <i class="fas fa-plus"></i>
        </a>
      </div>
      {{-- // TODO --}}
      {{-- {{ $todos->links('vendor.pagination.default') }}--}}
    </div>
  </main>
@endsection