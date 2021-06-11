<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=M+PLUS+Rounded+1c">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href=""/>
  </head>
  <body data-spy="scroll" data-target="#navbar" data-offset="150">
    <div id="app">
      @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  </body>
</html>

