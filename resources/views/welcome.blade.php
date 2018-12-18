<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
        <!-- Style -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h3 class="margines">Serwis Kwiatowy</h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="user-name-home" href="{{route('home')}}" role="button">
                                <span class="caret">Home</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <section class="jumbotron text-center banner-jumbotron">
        <div class="container container-custom">
            <h1 class="jumbotron-heading-custom">Serwis Kwiatowy</h1>

        </div>
    </section>

    <div class="container container-custom-main">

        <div class="row">
            <div class="col-sm-2 col-md-4">
                <div class="thumbnail">
                    <img src="/images/banner.jpg" alt="roza" width="200px" height="200px">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>Count:</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>




            <div class="col-sm-2 col-md-4">
                <div class="thumbnail">
                    <img src="/images/banner.jpg" alt="roza" width="200px" height="200px">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>Count:</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>



            <div class="col-sm-2 col-md-4">
                <div class="thumbnail">
                    <img src="/images/banner.jpg" alt="roza" width="200px" height="200px">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>Count:</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>


    </div>
    </div>

    </body>
</html>
