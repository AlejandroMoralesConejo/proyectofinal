@extends('layouts.app')

@section('content')
    <div class="alert alert-primary my-4" role="alert">
        <input class="form-control mx-1 my-2" id="buscador" type="text" placeholder="Busca tu partido. Prueba con día, hora, nombre, pista..." />
    </div>

    @foreach ($partidos as $partido)

    <div id="fila" class="row">
        <div class="card w-100 hoverable mb-3 bg-white">
            {{-- Header of body with date --}}
            <div class="card-header">
                <div class="float-left">
                    <strong>{{ \Carbon\Carbon::parse($partido->fecha)->locale('es')->dayName }}, </strong>
                    {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                    
                </div>

                {{-- Hour --}}
                <div class="float-right"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</div>
            </div>
            {{-- Main information match --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-1 mx-3 my-3">
                        <h1 class="mb-5">{{ $partido->nombre }}</h1>
                        <h5 class="mb-3"><i class="fas fa-thumbtack"></i> Pista {{ $partido->pista->nombreP }}</h5>
                        <h5 class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $partido->pista->direccionP }}</h5>
                    </div>

                    {{-- Name and place --}}
                    <div class="col-md-6 offset-md-1 mx-3 my-3">
                        <div class="row">
                            {{--<div class="col-md-6">
                                Button to register to the match (disabled)
                                <form action="{{ route('addMatch') }}" method="GET">
                                    <input type="hidden" name="limite" value="{{ $partido->limite }}" />
                                    <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                    <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
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
                                <a href="{{ route('partido.mostrar', $partido->idPartido) }}"><button class="btn btn-outline-primary btn-lg">VER PARTIDO</button></a>
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
    @endforeach
    <div id="paginacion">{{ $partidos->links() }}</div>
    
@endsection