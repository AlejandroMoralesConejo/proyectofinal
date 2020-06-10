@extends('layouts.app')
<script src="{{ asset('js/app.js') }}"></script>

@section('content')

    <div class="row">
        <div class="col-sd-12 mx-auto my-5">
            <h1 class="h1">Edita tu perfil</h1>
        </div>
    </div>

    <!-- success message for data update -->
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
    @endif

    @if(Session::has('foto'))
        <div class="alert alert-success">
            {{ Session::get('foto') }}
            @php
                Session::forget('foto');
            @endphp
        </div>
    @endif


    <div class="card bg-light py-4 px-4 border border-secondary">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ auth()->user()->foto }}" class="img-thumbnail">
                <form enctype="multipart/form-data" action="{{ route('perfil.foto') }}" method="POST">
                    @csrf
                    <label class="col-form-label" for="foto">Cambia tu foto de perfil:</label><br>
                    <input type="file" name="foto">
                    <input type="hidden" name="idJug" value="{{ auth()->user()->idJug }}"/>
                    <button class="btn btn-primary mt-2" type="submit">Actualizar foto</button>
                </form>
            </div>
            
            <!-- register form -->
            <div class="col-md-6 py-2 px-2">
            
                <form action="{{ route('perfil.store') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="idJug" value="{{ auth()->user()->idJug }}">
                    <!-- email -->
                    <div class="row form-group">
                        <div class="col-md-10 mx-auto">
                            <label class="col-form-label" for="emailEdit">Correo electrónico:</label>
                            <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}" required />
                            @if ($errors->has('email'))
                                <span class="text-danger">Has introducido un email que ya está en uso</span>
                            @endif
                        </div>
                    </div>

                    <!-- name -->
                    <div class="row form-group">
                        <div class="col-md-10 mx-auto">
                            <label class="col-form-label" for="nombreJ">Nombre:</label>
                            <input class="form-control" type="text" name="nombreJ" value="{{ auth()->user()->nombreJ }}" required />
                        </div>
                    </div>
                    @if ($errors->has('nombreJ'))
                        <span class="text-danger">{{ $errors->first('nombreJ') }}</span>
                    @endif

                    <!-- position -->
                    <div class="row form-group">
                        <div class="col-md-10 mx-auto">
                            <label class="col-form-label" for="posicion">Posición:</label>
                            <!--<input class="form-control" type="text" name="posicion" required />-->
                            <select class="form-control" name="posicion" required>
                                <option {{ auth()->user()->posicion == "derecha" ? "selected" : "" }} value="derecha">Derecha</option>
                                <option {{ auth()->user()->posicion == "reves" ? "selected" : "" }} value="reves">Revés</option>
                                <option {{ auth()->user()->posicion == "ambos" ? "selected" : "" }} value="ambos">Ambos</option>
                            </select>
                        </div>
                    </div>
                    @if ($errors->has('posicion'))
                        <span class="text-danger">{{ $errors->first('posicion') }}</span>
                    @endif

                    <!-- birthdate -->
                    <div class="row form-group">
                        <div class="col-md-10 mx-auto">
                            <label class="col-form-label" for="fec_nacimiento">Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" name="fec_nacimiento" value="{{ auth()->user()->fec_nacimiento }}" />
                        </div>
                    </div>

                    <!-- register confirm -->
                    <div class="row form-group">
                        <div class="col-md-10 mx-auto">
                            <button class="btn btn-primary w-100" type="submit">Actualizar perfil</button>
                        </div>
                    </div>
                </form>

                <!-- delete account -->
                <div class="row form-group">
                    <div class="col-md-10 mx-auto">
                            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#exampleModal">BORRAR CUENTA</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de que quieres borrar tu cuenta?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('perfil.borrar') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ auth()->user()->idJug }}" name="idJugador">
                                            <button type="submit" class="btn btn-danger w-100">Borrar</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div> {{-- end row data --}}
        </div> 
    </div> {{-- end card --}}

@endsection