@extends('layouts.app')

@section('content')
<div id="fila" class="row">
    <div class="card w-100 hoverable my-5 bg-light border">
        {{-- Head with date --}}
        <div class="card-header cardheader text-light">
            <div class="row">
                <div class="h5 col-md-4">
                    <strong>{{ \Carbon\Carbon::parse($partido->fecha)->locale('es')->dayName }}, </strong>
                    {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                </div>
                <div class="h2 col-md-4 text-center">{{ $partido->nombre }}</div>
                <div class="h5 col-md-4 text-right"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</div>
            </div>
        </div>
        <div class="card-body bg-light">
            <div class="row">

                {{-- Loop for players assignment --}}

                    {{-- Players --}}

                    @php
                        $x = 0;
                    @endphp
                    @foreach ($jugadores as $jugador)
                        @php
                            $x++;
                        @endphp
                        @if ($x == 3 && $numJugadores > 2)
                            <div class="col-md-4 text-center">
                            @if ($logueadoPertenece == false)
                                <form id="apuntar" action="{{ route('partido.add') }}" method="GET">
                                    <!-- <input type="hidden" name="limite" value="{{ $partido->limite }}" /> -->
                                    <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                    <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
                                    <button type="submit" class="btn btn-primary" {{ ($partido->limite == 4 || $logueadoPertenece) ? "disabled" : "" }} >
                                        @if ($logueadoPertenece)
                                            Ya estás apuntado
                                        @elseif ($partido->limite == 4)
                                            Partido completo
                                        @else
                                            Apúntate
                                        @endif
                                    </button>
                                </form>
                            @else

                                <form action="{{ route('partido.leave') }}" method="GET">
                                    <!-- <input type="hidden" name="limite" value="{{ $partido->limite }}" /> -->
                                    <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                    <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
                                    <button type="submit" class="btn btn-danger">
                                        Abandonar partido
                                    </button>
                                </form>
                            @endif
                            </div>
                        @endif
                        <div class="col-md-2 text-center">
                            <img src="{{ asset($jugador->foto) }}" class="img-thumbnail">
                            <hr>
                            <div class="bg-light text-dark">
                                <strong>{{ $jugador->nombreJ }}</strong><br>
                                {{ $jugador->posicion }}
                            </div>
                        </div>
                    @endforeach

                    {{-- Gaps --}}

                    @for ($i = 4-$numJugadores; $i > 0; $i--)
                        {{-- Insert VS in the middle of the match --}}
                        @if ($i == 2)
                            <div class="col-md-4 text-center">
                                <!-- <div class="row text-center"> -->
                                    @if ($logueadoPertenece == false)
                                        <form id="apuntar" action="{{ route('partido.add') }}" method="GET">
                                            <!-- <input type="hidden" name="limite" value="{{ $partido->limite }}" /> -->
                                            <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                            <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
                                            <button type="submit" class="btn btn-primary" {{ ($partido->limite == 4 || $logueadoPertenece) ? "disabled" : "" }} >
                                                @if ($logueadoPertenece)
                                                    Ya estás apuntado
                                                @elseif ($partido->limite == 4)
                                                    Partido completo
                                                @else
                                                    Apúntate
                                                @endif
                                            </button>
                                        </form>
                                    @else

                                        <form action="{{ route('partido.leave') }}" method="GET">
                                            <!-- <input type="hidden" name="limite" value="{{ $partido->limite }}" /> -->
                                            <input type="hidden" name="idPartido" value="{{ $partido->idPartido }}" />
                                            <input type="hidden" name="idJugador" value="{{ auth()->user()->idJug }}" />
                                            <button type="submit" class="btn btn-danger">
                                                Abandonar partido
                                            </button>
                                        </form>
                                    @endif
                                <!-- </div> -->
                            </div>
                        @endif
                        <div class="col-md-2 text-center">
                            <img src="{{ asset('img/default.png') }}" class="img-thumbnail"><hr>
                            <div class="bg-light text-dark">
                                <br>Plaza libre
                            </div>
                        </div>
                    @endfor


            </div>
        </div>
    </div>
</div>
@endsection