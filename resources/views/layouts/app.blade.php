<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- 3rd Party Connections -->
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.css') : asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.min.css') : asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="text/javascript" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.js') : asset('bootstrap/css/bootstrap.js')}}">
    <link rel="text/javascript" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.min.js') : asset('bootstrap/css/bootstrap.min.js')}}">
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('css/style.css') : asset('css/style.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-center" href="{{ url('/') }}">
                    {{ config('global.app_name', 'Laravel') }}
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
