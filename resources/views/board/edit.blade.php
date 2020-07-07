@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="d-flex align-items-center mt-5">
            <h1>掲示板編集</h1>
            <div class="ml-auto boards__linkBox">
                <a class="btn btn-outline-dark" href="{{route('boards.index')}}">一覧</a>
            </div>
        </div>

        @include('common.error_message')
        @include('board.form')
    </main>
@endsection
