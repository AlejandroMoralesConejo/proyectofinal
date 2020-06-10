<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Padelemotion') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/crud.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>

    <!-- Check register with AJAX, dissabled because this function is solved with Laravel -->
    <!-- <script src="{{ asset('js/checkRegister.js') }}"></script> -->

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/cb07d5ce28.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/padel.css') }}" rel="stylesheet">






</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h4 id="navb" class="h4">{{ config('app.name', 'Padelemotion') }}</h4>
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Inicia sesión') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombreJ }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('perfil').submit();">
                                        {{ __('Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="perfil" action="{{ route('perfil') }}" method="GET" style="display: none;">
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- yield faq is only for faq view -->
        @yield('faq')
        <div class="container">
            <main class="py-4">
                <!-- yield for all views less faq -->
                @yield('content')

            </main>

        </div>
        <footer class="navbar fixed-bottom bg-dark text-white py-2">
            <div class="container">
                <p>
                    <a href="{{ route('faq') }}">Padelemotion</a>
                    es un proyecto realizado para el trabajo final de DAW (Desarrollo de aplicaciones web)
                </p>
            </div>
        </footer>
    </div>
</body>

<!-- script for chart js -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var valores1 = [8, 12, 15, 16, 23, 33, 45];
    var valores2 = [13, 10, 18, 13, 30, 25, 35];

    var label = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"];





    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'Partidos amateurs',
                data: valores1,
                backgroundColor: '#ed3e72',
                borderColor: 'white',
                borderWidth: 1
            },
            {
                label: 'Partidos profesionales',
                data: valores2,
                backgroundColor: '#3db4ba',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false
        }
    });
</script>
</html>
