@extends('layouts.app')

@section('content')

    <section class="position-relative h-100 pb-4">

        <!-- Sign in form -->
        <div class="container d-flex justify-content-center align-self-center h-100 ">
            <div class="w-100 pt-1 pt-md-4 pb-4" style="max-width: 526px;">
                <section class="text-center mb-5">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </section>

                <form id="form-login" class="needs-validation" method="POST" action="{{ route('login') }}" novalidate>

                    @csrf

                    <h3 class="text-center mb-4">{{ __('Login') }}</h3>

                    <div class="mb-4">
                        <label for="email" class="form-label fs-base">{{ __('Correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" name="email" onkeyup="clearForm(this.value, 'email')">
                        @error('email')
                            <span class="invalid-feedback error-serve" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                        <span class="invalid-feedback" id="error-email" role="alert"></span>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fs-base">{{ __('Contraseña') }}</label>
                        <div class="password-toggle">
                            <input type="password" id="password" name="password" class="form-control form-control-lg">
                            <span class="invalid-feedback" role="alert">Este campo es obligatorio</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Iniciar sesión') }}</button>

                </form>

                <hr class="my-4">

                <div class="row mt-3">
                    <!-- <div class="col-md-6">
                        <p class="text-center pb-3 mb-3"><a href="password/reset">{{ __('¿Olvidaste tu contraseña?') }}</a></p>
                    </div> -->
                    <div class="col-md-12">
                        <p class="text-center pb-3 mb-3"><a href="/" class="btn btn-info btn-lg w-100 text-white">{{ __('Registrate aquí') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

