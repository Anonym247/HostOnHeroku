<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.css') : asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.min.css') : asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="text/javascript" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.js') : asset('bootstrap/css/bootstrap.js')}}">
    <link rel="text/javascript" href="{{ (env('APP_ENV') != 'local') ? secure_asset('bootstrap/css/bootstrap.min.js') : asset('bootstrap/css/bootstrap.min.js')}}">
    <link rel="stylesheet" href="{{ (env('APP_ENV') != 'local') ? secure_asset('css/style.css') : asset('css/style.css')}}">

    @csrf
    <title>{{config('global.app_name')}}</title>
</head>
<body style="
    background-image: url('{{config('global.background')}}');
    background-color: {{config('global.bg-color')}};
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    ">
    <div class="header">
        <div class="profile">
                @guest
                        <a class="profile_buttons" href="{{ route('login') }}">{{ __('Login') }}</a>
                @else
                        <span class="profile_buttons" href="" role="button" >
                            {{ 'Xos gelmisiz, ' . Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST">
                            <input type="submit" value="Log out" class="btn btn-primary btn-lg btn-block ">
                            @csrf
                        </form>
                @endguest
        </div>
        <div class="col-md-4">
            <a href="{{route('home')}}"><img class="logo" src="{{config('global.logo')}}" alt="logo"></a>
        </div>
        <div class="col-md-8">
           @guest
            @else
                <div class="settings">
                    <a href="{{route('settings')}}"><img src="{{config('app.images.settings')}}" alt="settings"></a>
                </div>
            @endguest
        </div>
    </div>
    <div class="menu">
        <nav id="header" class="navbar">
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="brand" class="navbar-brand" href="{{route('home')}}">{{config('global.app_name')}}</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{route('motion')}}">Başla</a></li>
                        @guest
                        @else

                            <li class="active"><a href="{{route('manage')}}">Tənzimlə</a></li>
                        @endguest
                        <li><a href="{{route('about_us')}}">Haqqımızda</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="main_content">
        @yield('content')
    </div>
</body>
</html>
