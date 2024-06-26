@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Personal')
@section('content')
    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>

    <script src="{{ asset('js/personal/personal.js') }}"></script>

    <div class="container">
        <main>
            <h1>Administrar Personal</h1>
            <div class="card">
                <div class="card-header">
                    <h5>Información del Personal</h5>
                </div>
                <div class="card-body">
                    <form class="row g-2 justify-content-start" action="javascrip:void(0)" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value=""
                                    onkeyup="return ValidarTexto(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="apellidos" class="form-label">Apellido:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" value=""
                                    onkeyup="return ValidarTexto(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="dni" class="form-label">DNI:</label>
                                <input type="text" id="dni" name="dni" class="form-control" value=""
                                    placeholder="Número de 9 digitos." onkeyup="return ValidarNumeros(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" id="celular" name="celular" class="form-control" value=""
                                    placeholder="Número de 9 digitos." onkeyup="return ValidarNumeros(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="condicion" class="form-label">Condición:</label>
                                <select id="condicion" name="condicion" class="form-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="servicio" class="form-label">Servicio:</label>
                                <select id="servicio" name="servicio" class="form-select">
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-block"
                            onclick="GuardarPersona()">Registrar</button>
                    </form>
                    <hr />
                    <div class="shadow px-3 bg-body rounded m-2">
                        <!-- Tabla de informacion -->
                        <div class="table-responsive">

                            <div class="m-1 px-5 pb-1">
                                <input type="text" name="buscador" id="buscador" class="form-control" value=""
                                    placeholder="Buscar Personal en el Sistema ....." onkeyup="return ValidarTexto(this)">
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombres y Apellidos</th>
                                        <th>Celular</th>
                                        <th>Condición</th>
                                        <th>Servicio</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaPersonal">
                                </tbody>
                            </table>
                        </div>
                        <script src="{{ asset('js/personal/buscador.js') }}"></script>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
