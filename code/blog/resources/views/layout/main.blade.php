<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.JWTAuth::fromUser(Auth::user()) : '' }}">
    <link href="/favicon.ico" rel="shortcut icon">
    <title>手记－让世界感受知识的存在</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @yield('css')
</head>
<body>
    <div id="app">
        @include('layout.header')
            @yield('content')
            <go-top></go-top>
        @include('layout.footer')
    </div>
</body>
<script src="{{ mix('/js/app.js') }}"></script>
@yield('js')
</html>
