@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombreJ" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="nombreJ" type="text" class="form-control @error('nombreJ') is-invalid @enderror" name="nombreJ" value="{{ old('nombreJ') }}" required autocomplete="nombreJ" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Posicion --}}
                        <div class="form-group row">
                            <label for="posicion" class="col-md-4 col-form-label text-md-right">{{ __('Posición') }}</label>

                            <div class="col-md-6">
                                <select id="posicion" class="form-control" name="posicion" required>
                                    <option selected value="">Elige una opción</option>
                                    <option value="derecha">Derecha</option>
                                    <option value="reves">Revés</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>
                        </div>
                        {{-- fin posicion --}}

                        {{-- fecha de nacimiento --}}
                        <div class="form-group row">
                            <label for="fnac" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>
                            
                            <div class="col-md-6">
                                <input id="fnac" class="form-control" type="date" name="fnac" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection