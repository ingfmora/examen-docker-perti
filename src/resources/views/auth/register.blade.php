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

            <form id="form-register" class="needs-validation mb-2">

                @csrf

                <h3 class="text-center mb-4">{{ __('Registro') }}</h3>

                <div class="mb-4">
                    <label for="email" class="form-label fs-base">{{ __('Nombre') }}</label>
                    <input id="name" type="text" class="form-control form-control-lg" name="name" autocomplete="name" autofocus onkeyup="clearForm(this.value, 'name')">
                    <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="phone" class="form-label fs-base">{{ __('Teléfono') }}</label>
                            <input type="number" id="phone" name="phone" class="form-control form-control-lg" autocomplete="phone" onkeyup="clearForm(this.value, 'phone')">
                            <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4 content-rfc">
                            <label for="rfc" class="form-label fs-base">{{ __('RFC') }}</label>
                            <input id="rfc" type="text" class="form-control form-control-lg text-uppercase" name="rfc" autocomplete="rfc" onkeyup="clearForm(this.value, 'rfc')">
                            <div class="invalid-feedback invalid-rfc">{{ __('Ingresa un RFC valido') }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="notes" class="form-label fs-base">{{ __('Notas') }}</label>
                    <textarea id="notes" cols="auto" rows="4" class="form-control form-control-lg" name="notes" autocomplete="notes" onkeyup="clearForm(this.value, 'notes')"></textarea>
                    <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label fs-base">{{ __('Correo electrónico') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg" name="email" autocomplete="email" onkeyup="clearForm(this.value, 'email')">
                    <div class="invalid-feedback">{{ __('Ingresa un correo valido') }}</div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fs-base">{{ __('Contraseña') }}</label>
                    <div class="password-toggle">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" onkeyup="clearForm(this.value, 'password')">
                        <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                    </div>
                </div>
                <div class="mb-4 content-confirm-password">
                    <label for="conf-password" class="form-label fs-base">{{ __('Confirmar Contraseña') }}</label>
                    <input type="password" id="password-confirm" name="password-confirm" class="form-control form-control-lg" onkeyup="clearForm(this.value, 'password-confirm')">
                    <div class="invalid-feedback">{{ __('La contraseña no coincide') }}</div>
                </div>

                <div id="buttons">
                    <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Registrar') }}</button>
                </div>
                <div id="loading" class="d-none">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> Procesando solicitud...
                </div>

            </form>

            <hr class="my-4">

            <div class="row mt-3">
                <p class="text-center pb-3 mb-3"><a href="/login" class="btn btn-info btn-lg w-100 text-white">{{ __('Iniciar sesión') }}</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
