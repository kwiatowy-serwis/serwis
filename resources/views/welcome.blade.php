<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Serwis kwiatowy</title>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                <a class="dropdown-item" href="{{URL('home')}}">Home</a>

                                @if(Auth()->user()->isAdmin())
                                    <a class="dropdown-item" href="{{URL('admin')}}">Admin panel</a>
                                @endif

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
            <div class="col-sm-12 col-md-10">
            <h1 class="jumbotron-heading-custom">Serwis Kwiatowy</h1>
                <h2>Z której kwiaciarni chcesz skorzystać?</h2>

                <form action="{{route('welcome')}}" method="GET">
                    <select class="form-control form-control-custom" name="cityName">
                    @if($cityChoice == "Kraków")
                            <option>Kraków</option>
                            <option>Rzeszów</option>

                    </select>
                        @else

                        <option>Rzeszów</option>
                        <option>Kraków</option>


                    @endif
                        </select>
                    <br/>
                    <button class="btn btn-primary" type="submit">Zmień lokalizacje</button>

                </form>

            </div>
        </div>
    </section>

    <div class="container container-custom-main">

        @yield('content')


    </div>
    <footer style="background-color: grey">
        <div class="footer-copyright text-center py-3">© 2018 Copyright by Kwiatowy Serwis

        </div>
    </footer>

    </body>
</html>
