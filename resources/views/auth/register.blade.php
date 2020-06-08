@extends('layouts.app')

@section('content')
    <img id="fondo" src="{{ asset('img/wallp.jpg') }}"/>
    <!-- register-->
    <div class="row">
        <div class="col-sd-12 mx-auto mb-5">
            <h4>Registro</h4>
        </div>
    </div>

    
    <!-- register form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- email -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" 
                        placeholder="correo electrónico" value="{{ old('email') }}" required />
                <span id="error_email"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- name -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <input class="form-control @error('nombreJ') is-invalid @enderror" type="text" name="nombreJ" placeholder="nombre" value="{{ old('nombreJ') }}" required />
                @error('nombreJ')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- password -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="contraseña" required autocomplete="new-password">
                <small class="form-text text-muted mb-2">
                    Debe tener al menos 4 caracteres
                </small>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>Las contraseñas no coinciden o no tienen 4 caracteres</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- password confirm -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirma la contraseña" required autocomplete="new-password">
            </div>
        </div>

        <!-- position -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <select id="posicion" class="form-control" name="posicion" required>
                    <option selected value="">Elige tu posición preferida</option>
                    <option value="derecha">Derecha</option>
                    <option value="reves">Revés</option>
                    <option value="ambos">Ambos</option>
                </select>
            </div>
        </div>

        <!-- birthdate -->
        <div class="row form-group">
            <div class="col-md-4 mx-auto">
                <input id="fec_nacimiento" class="form-control" type="date" name="fec_nacimiento" required/>
                <small class="form-text text-muted mb-2">
                    Introduce tu fecha de nacimiento
                </small>
            </div>
        </div>

        <!-- register button -->
        <div class="row">
            <div class="col-md-4 mx-auto">
                <button id="register" class="btn btn-primary w-100" type="submit">Registrar</button>
            </div>
        </div>
    </form>
@endsection