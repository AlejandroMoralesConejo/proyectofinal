@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->













<div class="alert alert-primary my-4" role="alert">
    <input class="form-control mx-1 my-2" id="buscador" type="text" placeholder="Busca tu partido. Prueba con día, hora, nombre, pista..." />
</div>
<!-- {% for torneo in data %} -->
@foreach ($partidos as $partido)

<div id="fila" class="row">
    <div class="card w-100 hoverable mb-3 bg-white">
        {{-- Header of body with date --}}
        <div class="card-header">
            <div class="float-left">
                @switch(\Carbon\Carbon::parse($partido->fecha)->isoFormat('dd'))
                @case('Mo')
                <strong>Lunes</strong>,
                @break

                @case('Tu')
                <strong>Martes</strong>,
                @break

                @case('We')
                <strong>Miércoles</strong>,
                @break

                @case('Th')
                <strong>Jueves</strong>,
                @break

                @case('Fr')
                <strong>Viernes</strong>,
                @break

                @case('Sa')
                <strong>Sábado</strong>,
                @break

                @default
                <strong>Domingo</strong>,
                @endswitch
                
                {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                
                {{--  {% if torneo.dia == 'Monday' %}
                            <strong>Lunes</strong>,
                        {% elseif torneo.dia == 'Tuesday' %}
                            <strong>Martes</strong>,
                        {% elseif torneo.dia == 'Wednesday' %}
                            <strong>Miércoles</strong>,
                        {% elseif torneo.dia == 'Thursday' %}
                            <strong>Jueves</strong>,
                        {% elseif torneo.dia == 'Friday' %}
                            <strong>Viernes</strong>,
                        {% elseif torneo.dia == 'Saturday' %}
                            <strong>Sábado</strong>,
                        {% else %}
                            <strong>Domingo</strong>,
                        {% endif %}{{ torneo.fecha }} --}}
            </div>
            <div class="float-right"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</div>
        </div>
        {{-- Main information match --}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 offset-md-1 mx-3 my-3">
                    <h2 class="h2 mb-5">{{ $partido->nombre }}</h2>
                    <h5 class="h5 mb-3"><i class="fas fa-thumbtack"></i> Pista {{ $partido->pista->nombreP }}</h5>
                    <h5 class="h5 mb-1"><i class="fas fa-map-marker-alt"></i> {{ $partido->pista->direccionP }}</h5>
                </div>

                {{-- Name and place --}}
                <div class="col-md-6 offset-md-1 mx-3 my-3">
                    <div class="row">
                        {{--<div class="col-md-6">
                            Button to register to the match 
                            <form action="{{ route('addMatch') }}" method="GET">
                                <!-- <input type="hidden" name="con" value="partido"/>
                                        <input type="hidden" name="ope" value="add"/> -->
                                <input type="hidden" name="limite" value="{{ $partido->limite }}" />
                                <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
                                <!-- TRABAJAR A PARTIR DE AQUI LA VISTA, BUSCAR LOS ROUTES PARA EL BOTÓN DE APUNTARSE A TORNEO Y APLICARLE MIDDLEWARE DE AUTENTIFICACIÓN -->
                                <button id="boton" type="submit" class="btn btn-primary" {{ (($partido->limite == 4) || (idPart == torneo.idPartido)) ? "disabled" : "" }} >
                                    @if (idPart == torneo.idPartido)
                                        Ya estás apuntado
                                    @else
                                        Apúntate
                                    @endif
                                </button>
                            </form>
                        </div>--}}

                        <div class="col-md-6">
                            <a href="{{ route('partido.mostrar', $partido->idPartido) }}"><button class="btn btn-light">Ver partido</button></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 offset-md-1 mx-3 my-3"><hr>
                            @if ($partido->limite == 3)
                                <h3>Queda 1 plaza para cerrar el partido.</h3>
                            @elseif ($partido->limite == 4)
                                <h3 class="text-danger">Partido cerrado.</h3>
                            @else
                                <h3>Quedan {{ 4-($partido->limite) }} plazas para cerrar el partido.</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- {% endfor %} -->
@endforeach
@endsection