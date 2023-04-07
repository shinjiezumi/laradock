@extends('layouts.mycolle')
@section('title', 'マイコレ管理')

@section('content')
  <div class="setting-container">
    <ul id="jsc-setting-type-select-tab" class="setting-type-select-tab">
      <li class="jsc-setting-type-select-tab-item select">マイサイト</li>
      <li class="jsc-setting-type-select-tab-item">マイコレ</li>
    </ul>
    <div class="setting-type-select-tab-contents">
      <div class="jsc-setting-type-select-tab-contents-item select">
        @if(session('mysites_message'))
          <div class="flash_message" onclick="this.classList.add('hidden')">
            {{session('mysites_message')}}
          </div>
        @endif
        <div class="mysites-list-container">
          <div class="loader-bg">
            <div class="loader">
              <span class="loader-msg">Now Loading...</span>
            </div>
          </div>

          <div id="jsc-mysites-list" class="mysites-list">

          </div>
        </div>
        <div class="add-btn-container">
          <button id="jsc-add-mysites-btn" class="add-btn">+</button>
        </div>

        <div id="jsc-mysites-type-select-tab-container" class="search-container" style="display: none;">
          <ul id="jsc-mysites-type-select-tab" class="mycolle-type-select-tab">
            <li class="mysites-type-select-tab-item feedly-color select">Feedly</li>
          </ul>
          <div class="mysites-type-select-tab-contents">
            <div class="mysites-type-select-tab-contents-item">
              <div class="search-box-container">
                <input id="jsc-search-feed-box" class="search-box" type="text" placeholder="検索キーワード">
              </div>
              <div class="search-container">
                <div class="loader-bg search-feed" style="display: none;">
                  <div class="loader">
                    <span class="loader-msg">Searching...</span>
                  </div>
                </div>

                <div id="jsc-search-feed-results" class="search-results-container">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="jsc-setting-type-select-tab-contents-item" style="display: none;">
        @if(session('mycolle_message'))
          <div class="flash_message" onclick="this.classList.add('hidden')">
            {{session('mycolle_message')}}
          </div>
        @endif
        <div class="mycolle-list-container">
          <div class="loader-bg" style="display: none;">
            <div class="loader">
              <span class="loader-msg">Now Loading...</span>
            </div>
          </div>

          <div id="jsc-mycolle-list" class="mycolle-list">

          </div>
        </div>
        <div class="add-btn-container">
          <button id="jsc-add-mycolle-btn" class="add-btn">+</button>
        </div>

        <div id="jsc-mycolle-type-select-tab-container" class="search-container" style="display: none;">
          <ul id="jsc-mycolle-type-select-tab" class="mycolle-type-select-tab">
            <li class="mycolle-type-select-tab-item slideshare-color select">Slideshare</li>
            <li class="mycolle-type-select-tab-item youtube-color">Youtube</li>
            <li class="mycolle-type-select-tab-item html-color">HTML</li>
          </ul>
          <div class="mycolle-type-select-tab-contents">
            <div class="mycolle-type-select-tab-contents-item">
              <div class="search-box-container">
                <input id="jsc-search-slide-box" class="search-box" type="text"
                       placeholder="検索キーワード">
              </div>
              <div class="search-container">
                <div class="loader-bg search-slide" style="display: none;">
                  <div class="loader">
                    <span class="loader-msg">Searching...</span>
                  </div>
                </div>

                <div id="jsc-search-slide-results" class="search-results-container">

                </div>
              </div>

            </div>
            <div class="mycolle-type-select-tab-contents-item" style="display: none;">
              <div class="search-box-container">
                <input id="jsc-search-youtube-box" class="search-box" type="text"
                       placeholder="検索キーワード">
              </div>
              <div class="search-container">
                <div class="loader-bg search-youtube" style="display: none;">
                  <div class="loader">
                    <span class="loader-msg">Searching...</span>
                  </div>
                </div>

                <div id="jsc-search-youtube-results" class="search-results-container">

                </div>
              </div>
            </div>
            <div class="mycolle-type-select-tab-contents-item" style="display: none;">
              <div class="search-box-container">
                <input id="jsc-search-html-box" class="search-box" type="text"
                       placeholder="URL">
              </div>
              <div class="search-container">
                <div class="loader-bg search-html" style="display: none;">
                  <div class="loader">
                    <span class="loader-msg">Searching...</span>
                  </div>
                </div>

                <div id="jsc-search-html-results" class="search-results-container">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('stylesheets')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('javascripts')
  <script src="/js/settings.js?v={{env('JS_VERSION', '1')}}"></script>
@endsection
