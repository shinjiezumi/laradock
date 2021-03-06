@extends('layouts.app')

@section('title', env('APP_NAME'))

@section('content')
  <main class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            <h5 class="card-title text-white">掲示板</h5>
          </div>
          <img src="/img/boards.png" class="card-img-top border-bottom" alt="掲示板アプリ">
          <div class="card-body">
            <p class="card-text">シンプルな掲示板アプリ</p>
            <a href="/boards" class="btn btn-secondary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
