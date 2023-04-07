<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'マイコレ') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet">
    @yield('stylesheets')
    <link href="/css/mycolle.css?v={{env('CSS_VERSION', '1')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
      window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
  </head>
  <body id="app" class="app-container">
    <header class="header-container">
      <div class="site-logo-container">
        <h1 class="site-logo">
          <a class="site-logo-link" href="{{ url('/') }}"> {{ config('app.name', 'マイコレ') }}</a>
        </h1>
      </div>
      <nav class="header-nav-container">
        <div id="jsc-header-toggle" class="toggle-icon"><a href="#"></a></div>
        <div>
          <ul id="jsc-header-nav" class="header-nav" style="display: none">
            <!-- Authentication Links -->
            @if (Auth::guest())
              <li class="header-nav-item">
                <a class="header-nav-item-link" href="{{ url('/login') }}">ログイン</a>
              </li>
              <li class="header-nav-item">
                <a class="header-nav-item-link" href="{{ url('/register') }}">新規登録</a>
              </li>
            @else
              <li class="header-nav-item">
                <a class="header-nav-item-link" href="{{ url('/mycolle/settings') }}">マイコレ管理</a>
              </li>
              <li class="header-nav-item">
                <a class="header-nav-item-link" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>

            @endif
          </ul>
        </div>
      </nav>
    </header>
    <main class="main-container">
      <div class="main-container-inner">
        @if(session('flash_message'))
          <div class="flash_message" onclick="this.classList.add('hidden')">
            {{session('flash_message')}}
          </div>
        @endif

        @yield('content')
      </div>
    </main>
    <footer class="footer-container">
      <nav class="footer-nav-container">
        <ul class="footer-nav">
          <li class="footer-nav-item"><a class="footer-nav-item-link" href="#">利用規約</a></li>
          <li class="footer-nav-item"><a class="footer-nav-item-link" href="#">プライバシーポリシー</a></li>
        </ul>
      </nav>
      <p class="footer-copyright">
        Copyright&copy; 2023 マイコレ All right reserved.
      </p>
    </footer>

    <!-- Scripts -->
    <script src="/js/app.js?v={{env('JS_VERSION', '1')}}"></script>
    <script src="/js/common.js?v={{env('JS_VERSION', '1')}}"></script>
    @yield('javascripts')
  </body>
</html>
