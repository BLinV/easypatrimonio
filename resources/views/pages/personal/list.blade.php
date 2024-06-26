@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Personal')
@section('content')
    <div class="container">
        <main>
            <h1>Administrar Personal</h1>
            <div class="card">
                <div class="card-header">
                    <h5>Información del Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="apellidos" class="form-label">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="dni" class="form-label">DNI:</label>
                                <input type="text" id="dni" name="dni" class="form-control" value=""  placeholder="Número de 9 digitos.">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" id="celular" name="celular" class="form-control" value="" placeholder="Número de 9 digitos.">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="condicion" class="form-label">Condición:</label>
                                <select id="condicion" name="condicion" class="form-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="servicio" class="form-label">Servicio:</label>
                                <select id="servicio" name="servicio" class="form-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="shadow p-3 bg-body rounded mt-2">
                        <!-- Tabla de informacion -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombres y Apellidos</th>
                                        <th>Celular</th>
                                        <th>Condición</th>
                                        <th>Servicio</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaPersonal">
                                    <!-- Todo lo llena el metodo ListarPersonal()
                                        Proceso: JS llama a API, API llama a Controller, Controller devuelve a API y luego a JS,
                                        JS arma HTML e inyecta a Tabla(ID) -->
                                </tbody>
                            </table>
                        </div>
                        <script src="{{ asset('js/personal.js') }}"></script>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection