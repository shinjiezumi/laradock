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

@section('javascripts')
  <script src="{{ mix('js/mycolle/home.js') }}" defer></script>
@endsection
