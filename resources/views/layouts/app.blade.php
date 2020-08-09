<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
 @if (session('flash_message'))
    <div class="flash_message">
      <p class="flash_meg--txt"> {{ session('flash_message') }}
      <i class="far fa-thumbs-up"></i>
      </p>
</div>

@if (session('status'))
    <div class="flash_message">
      <p class="flash_meg--txt">  {{ session('status') }}
      <i class="far fa-thumbs-up"></i>
      </p>
</div>
@endif

@endif
<div id="app">
@yield('content')
</div>


</body>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ mix('js/app.js') }}"></script> 
</html>
