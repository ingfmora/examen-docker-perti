@extends('layouts.app')

@section('content')
<div>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="./images/logo/logo.png" alt="" width="75">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        {{ __('Cerrar sesión') }}
                    </a>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container pt-5">

        <div class="row">
            <div class="col-md-6 offset-3 card">
                <div class="card-body text-center">
                    <div class="d-table mx-auto mt-4 mb-3">
                        <x-application-avatar></x-application-avatar>
                    </div>
                    <h2 class="h5 mb-1">{{ $user['name'] }}</h2>
                    <p class="mb-3 pb-3">{{ $user['email'] }}</p>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <!-- Users details -->
            <div class="col-md-12 justify-content-center card">
                <div class="card-body">
                    <h1 class="h2 pt-xl-1 pb-3">Lista de usuarios</h1>
                    <hr>
                    <div class="ps-md-3 ps-lg-0 mt-md-2 py-md-4">

                        <!-- Basic info -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="table-users" class="table table-striped"  style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Teléfono</th>
                                            <th class="text-center">RFC</th>
                                            <th class="text-center">Correo electrónico</th>
                                            <th class="text-center">Notas</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $key)
                                            <tr>
                                                <td class="text-center">{{ $key['name'] }}</td>
                                                <td class="text-center">{{ $key['phone'] }}</td>
                                                <td class="text-center">{{ $key['rfc'] }}</td>
                                                <td class="text-center">{{ $key['email'] }}</td>
                                                <td class="text-center">{{ $key['notes'] }}</td>
                                                <td class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="show({{ $key }})" data-bs-toggle="modal" data-bs-target="#modalStore">Editar</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalStore" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="form-register" class="needs-validation mb-2">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ __('Actualizar') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <input type="hidden" id="id" name="id">

                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label fs-base">{{ __('Nombre') }}</label>
                                        <input id="name" type="text" class="form-control form-control-lg" name="name" autocomplete="name" autofocus onkeyup="clearForm(this.value, 'name')">
                                        <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="phone" class="form-label fs-base">{{ __('Teléfono') }}</label>
                                        <input type="number" id="phone" name="phone" class="form-control form-control-lg" autocomplete="phone" onkeyup="clearForm(this.value, 'phone')">
                                        <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                                    </div>
                                    <div class="mb-4 content-rfc">
                                        <label for="rfc" class="form-label fs-base">{{ __('RFC') }}</label>
                                        <input id="rfc" type="text" class="form-control form-control-lg text-uppercase" name="rfc" autocomplete="rfc" onkeyup="clearForm(this.value, 'rfc')">
                                        <div class="invalid-feedback invalid-rfc">{{ __('Ingresa un RFC valido') }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label fs-base">{{ __('Cambiar Contraseña') }}</label>
                                        <div class="password-toggle">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" onkeyup="clearForm(this.value, 'password')">
                                            <div class="invalid-feedback">{{ __('Este campo es obligatorio') }}</div>
                                        </div>
                                    </div>
                                    <div class="mb-4 d-none" id="content-pass-confirm">
                                        <label for="password-confirm" class="form-label fs-base">{{ __('Confirmar contraseña') }}</label>
                                        <div class="password-toggle">
                                            <input type="password" id="password-confirm" name="password-confirm" class="form-control form-control-lg" onkeyup="clearForm(this.value, 'password-confirm')">
                                            <div class="invalid-feedback">{{ __('La contraseña no coincide') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="buttons">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <div id="loading" class="d-none">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div> Procesando solicitud...
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

