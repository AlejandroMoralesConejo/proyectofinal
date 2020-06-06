@extends('layouts.app')

@section('content')
    <!-- background -->
    <img id="fondo" src="{{ asset('img/wallp.jpg') }}"/>

    <div class="row align-items-start">
        <div class="col">
            <form class="align-items-center" method="POST" action="{{ route('login') }}">
                @csrf
                <!-- logotipe -->
                <div class="row">
                    <div class="col-sd-12 mx-auto">
                        <img class="logo" src="{{ asset('img/padelemotion.png') }}" alt="PadelEmotion" />
                    </div>
                </div>
        
                <!-- login form -->
                <!-- email -->
                <div class="row mt-5 form-group">
                    <div class="col-md-4 offset-md-4">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" 
                                name="email" placeholder="correo electrónico" value="{{ old('email') }}" required />
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>El email introducido no es correcto.</strong>
                        </span>
                    @enderror
                </div>

                

                <!-- password -->
                <div class="row form-group">
                    <div class="col-md-4 offset-md-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" required autocomplete="current-password" placeholder="contraseña" required>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>La contraseña no coincide con el correo introducido.</strong>
                        </span>
                    @enderror
                </div>

                <!-- remember button -->
                <div class="row form-group">
                    <div class="col-md-4 offset-md-4">

                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                            <label class="custom-control-label" for="remember">{{ __('Recordar') }}</label>
                        </div>
                    </div>
                </div>

                <!-- request password -->

                <!-- <a class="btn btn-link" href="{{ route('password.request') }}"></a> -->

                <!-- login -->
                <div class="row form-group">
                    <div class="col-md-4 offset-md-4 text-right">
                        <button class="btn btn-primary w-100" type="submit">entrar</button>
                    </div>
                </div>

                <div class="row form-group my-4">
                    <div class="col-md-4 offset-md-4 text-right">
                        <a class="btn btn-light w-100" href="{{ route('register') }}">regístrate</a>
                        <p class="form-text font-weight-bold">
                            ¿No tienes cuenta aún? ¿A qué esperas?
                        </p>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
@endsection
