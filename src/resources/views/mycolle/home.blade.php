@extends('layouts.mycolle')
@section('title', 'ホーム')

@section('content')
  <section class="mysite-contents-list-container">
    <h2><span class="type-label">新着コンテンツ</span></h2>
    <div id="jsc-mysite-contents-list"></div>
    <div class="loader-bg">
      <div class="loader">
        <span class="loader-msg">Now Loading...</span>
      </div>
    </div>

  </section>
  <section class="mycolle-list-container">
    <h2><span class="type-label">マイコレ</span></h2>
    <div class="loader-bg">
      <div class="loader">
        <span class="loader-msg">Now Loading...</span>
      </div>
    </div>

    <div id="jsc-mycolle-list" class="mycolle-list"></div>
  </section>
  <section id="last-ad" class="ad">

  </section>
@endsection

@section('stylesheets')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('javascripts')
  <script src="/js/home.js?v={{env('JS_VERSION', '1')}}"></script>
@endsection
