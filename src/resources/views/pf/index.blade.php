@extends('pf.layouts.app')

@section('title', 'ShinjiEzumi portfolio')

@section('content')
  <header>
    <div class="site-logo-container" id="home">
      <h1 class="site-logo">ShinjiEzumi portfolio</h1>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark global-navi">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
              aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto nav-list">
          <li class="navbar-item text-center"><a class="nav-link active" href="#home">Home</a></li>
          <li class="navbar-item text-center"><a class="nav-link" href="#about">About</a></li>
          <li class="navbar-item text-center"><a class="nav-link" href="#portfolio">Portfolio</a></li>
          <li class="navbar-item text-center"><a class="nav-link" href="#skills">Skills</a></li>
          <li class="navbar-item text-center"><a class="nav-link" href="#story">Story</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <main class="wrap">
    <section id="about" class="row">
      <h2 class="col-md-12 subtitle">About</h2>
      <div class="col-md-6 text-center">
        <img src="/img/about.jpeg" alt="" style="width: 300px; height: 300px; border-radius: 80%">
      </div>
      <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
        <ul class="mt-5 mt-sm-5">
          <li class="mb-3">名前: ezumi</li>
          <li class="mb-3">年齢: 33</li>
          <li class="mb-3">性別: 男</li>
          <li class="mb-3">出身: 島根</li>
          <li class="mb-3">興味あること: Golang、Vue</li>
        </ul>
      </div>
    </section>
    <section id="portfolio" class="row">
      <h2 class="col-md-12 subtitle">Portfolio</h2>
      <div class="col-md-12 text-center">Coming soon...</div>
    </section>
    <section id="skills" class="row">
      <h2 class="col-md-12 subtitle">Skills</h2>
      <div class="col-md-6 mb-5 text-center">
        <h3>PHP</h3>
        <div id="php-circle" class="circle"></div>
      </div>
      <div class="col-md-6 mb-5 text-center">
        <h3>インフラ</h3>
        <div id="infra-circle" class="circle"></div>
      </div>
      <div class="col-md-6 mb-5 text-center">
        <h3>HTML+CSS</h3>
        <div id="htmlcss-circle" class="circle"></div>
      </div>
      <div class="col-md-6 mb-5 text-center">
        <h3>Javascript</h3>
        <div id="js-circle" class="circle"></div>
      </div>
      <h3 class="col-md-12 mb-5 text-center">qualifying exam</h3>
      <div class="col-md-12">
        <div class="d-flex justify-content-center">
          <ul class="list-unstyled">
            <li class="small-text">2009年: OMG認定URL技術者 ファンダメンタル</li>
            <li class="small-text">2009年: JSTQB認定テスト技術者資格 Foundation Level</li>
            <li class="small-text">2009年: 基本情報技術者</li>
            <li class="small-text">2016年: HTML5プロフェッショナル Level1</li>
            <li class="small-text">2016年: 応用情報技術者</li>
            <li class="small-text">2017年: 情報セキュリティマネジメント</li>
          </ul>
        </div>
      </div>
    </section>
    <section id="story" class="row">
      <h2 class="col-md-12 subtitle">Story</h2>
      <div class="col-md-12">
        <ul class="timeline">
          <li class="event small-text" data-date="1987">
            <p>島根県に生まれる。</p>
          </li>
          <li class="event small-text" data-date="2003">
            <p>家から一番近いという理由で商業高校の情報処理科に進学。</p>
            <p>初めてプログラミングを勉強する。言語はCOBOLとVB。</p>
          </li>
          <li class="event small-text" data-date="2006">
            <p>ゲーム系の専門学校に進学。</p>
            <p>学校ではVB少しとC言語を主に学ぶ。</p>
          </li>
          <li class="event small-text" data-date="2008">
            <p>新卒で大手SIerの広島支社に就職。</p>
            <p>ガラケーのソフトウェア開発チームに配属され、配属初日に先輩に「C++勉強しといて」と言われ、ひぃひぃ言いながら勉強する。</p>
          </li>
          <li class="event small-text" data-date="2009">
            <p>某メーカー企業に派遣として常駐し、スマホのプロトコルスタック周りを担当。</p>
            <p>過去一難しい案件で、かつプロパーの方が全員優秀＋求めている水準も高く、これまたひぃひぃ言いながら業務をこなす。</p>
            <p>大変だったけど一番経験が積めたプロジェクトだった。</p>
          </li>
          <li class="event small-text" data-date="2014">
            <p>転職＋上京でWeb系にシフトすることになり、Javaで航空系システム、プリカ決済システムの開発を担当。</p>
            <p>このプロジェクトで初めて単体テスト（JUnit）を経験する。</p>
          </li>
          <li class="event small-text" data-date="2016">
            <p>転職してPHPでMA開発を担当。</p>
            <p>PHP歴1週間ながらも気合いで食らいつき、オンスケで業務を消化する。</p>
            <p>前任者が抜けた後に前任者のバグが大量に見つかり、担当タスクと並行して気合いで駆逐する。</p>
          </li>
          <li class="event small-text" data-date="2018">
            <p>今までの案件が全てSESだったので、転職ではなくフリーランスに転身。</p>
            <p>PHPでBtoC向けECサイト開発を担当。</p>
            <p>フリーだと自分に専念できるので、しばらく会社員はいいかなと感じる。</p>
          </li>
          <li class="event small-text" data-date="2019">
            <p>世間ではAWS、GCPやコンテナ技術、CI/CDを使った自動デプロイなどが当たり前になりつつあり、ほとんど経験できていないことに危機感を持つ。</p>
            <p>モダンな技術や言語を中心にスキルアップしていきたい。</p>
          </li>
        </ul>
      </div>
    </section>
    <div class="pagetop text-center" style="display: none">
      <i class="fa fa-arrow-up"></i>
    </div>
  </main>
  <footer class="footer d-flex justify-content-center">
    <div class="d-flex">
      <div class="mr-3 copyright">&copy; {{date('Y')}} <a href="{{env('APP_URL')}}"
                                                          class="copyright-link">shinjiezumi</a></div>
      <div>
        <ul class="d-flex list-unstyled sns-list">
          <li class="mr-3"><a href="https://twitter.com/shinjiezumi" target="_blank">
              <img src="/img/twitter.png" alt="twitter" class="sns-icon"></a>
          </li>
          <li class="mr-3"><a href="https://github.com/shinjiezumi" target="_blank">
              <img src="/img/github.png" alt="github" class="sns-icon"></a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
@endsection
