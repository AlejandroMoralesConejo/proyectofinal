@extends('layouts.app')
<!-- css for this view, slide banner -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/faq.js') }}"></script>
@section('faq')
    <!-- banner slider -->
    <div class="banner"></div>

    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid my-0 letra">
        <div class="container">
            <h1 class="display-4">¿Nadie se apunta a un partido el martes?</h1>
            <p class="lead">Padelemotion nace para que siempre tengas a alguien con quien jugar</p>
        </div>
    </div>

    <!-- video -->
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/jjoQpxVHqgY" allowfullscreen></iframe>
    </div>

    <!-- sound effects -->
    <div class="jumbotron jumbotron-fluid bg-dark text-light text-right letra">
        <div class="container">
            <h1 class="display-4">Vamos con unos sonidos</h1>
            <p class="lead">Esto es para que te familiarices</p>
        </div>
    </div>

    <!-- sounds -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-md-1">
                <a onclick="document.getElementById('golpe').play()" class="btn btn-outline-info btn-lg"><i class="fa fa-play" aria-hidden="true"></i> Golpe</a>
                <audio id="golpe" src="{{ asset('sonidos/golpe.mp3') }}" type="audio/mpeg">
            </div>

            <div class="col-md-3 offset-md-1">
                <a onclick="document.getElementById('pared').play()" class="btn btn-outline-info btn-lg"><i class="fa fa-play" aria-hidden="true"></i> Pared</a>
                <audio id="pared" src="{{ asset('sonidos/pared.mp3') }}" type="audio/mpeg">
            </div>

            <div class="col-md-3 offset-md-1">
                <a onclick="document.getElementById('gente').play()" class="btn btn-outline-info btn-lg"><i class="fa fa-play" aria-hidden="true"></i> Ovación</a>
                <audio id="gente" src="{{ asset('sonidos/gente.mp3') }}" type="audio/mpeg">
            </div>
        </div>

    </div>

    <!-- graph with canvas -->
    <div class="jumbotron jumbotron-fluid bg-light border mt-4">
        <div class="container">
            <h1 class="display-4">¡No paramos de crecer!</h1>
            <p class="lead">Todos estos partidos se han jugado en 2020</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 my-3">
                <canvas id="myChart" height="400" width="800"></canvas>
            </div>
        </div>
    </div>
    
@endsection



