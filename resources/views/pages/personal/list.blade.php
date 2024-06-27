@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Personal')
@section('content')
    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>

    <script src="{{ asset('js/personal/personal.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>

    <div class="container">
        <main>
            <h1>Administrar Personal</h1>
            <div class="card">
                <div class="card-header">
                    <legend>Información del Personal</legend>
                </div>
                <div class="card-body">
                    <form class="shadow p-3 mb-2 bg-body rounded row g-2 justify-content-start" action="javascript:void(0)"
                        method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return GuardarPersona()">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="dni" class="form-label">DNI:</label>
                                <input type="text" id="dni" name="dni" class="form-control" value=""
                                    placeholder="Número de 9 digitos." maxlength="8"
                                    placeholder="Ingrese el n° de identidad" onkeyup="return ValidarNumeros(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value=""
                                    onkeyup="return ValidarTexto(this)" placeholder="Ingrese el nombre">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="apellido" class="form-label">Apellidos:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" value=""
                                    onkeyup="return ValidarTexto(this)" placeholder="Ingrese el apellido">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="celular" class="form-label">Número de Celular:</label>
                                <input type="text" id="celular" name="celular" class="form-control" value=""
                                    placeholder="Número de 9 digitos." maxlength="9" placeholder="Ingrese el celular"
                                    onkeyup="return ValidarNumeros(this)">
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
                        <button type="submit" class="btn btn-primary btn-block"
                            onsubmit="GuardarPersona()">Registrar</button>
                    </form>
                    <div class="shadow px-3 bg-body rounded">
                        <!-- Tabla de informacion -->
                        <div class="table-responsive">
                            <div class="m-1 px-5 pb-1 pt-2">
                                <label for="buscador" class="form-label">Buscar en lista:</label>
                                <input type="text" id="buscador" name="buscador" class="form-control" value=""
                                    placeholder="Buscar Personal en el Sistema por NOMBRE o DNI ..." data-table="#tablaPersonal">
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
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
