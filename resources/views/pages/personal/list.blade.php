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
                    <form class="row g-2 justify-content-start" action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value=""  onkeyup="return ValidarTexto(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="apellidos" class="form-label">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" value="" onkeyup="return ValidarTexto(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="dni" class="form-label">DNI:</label>
                                <input type="text" id="dni" name="dni" class="form-control" value=""  placeholder="Número de 9 digitos." onkeyup="return ValidarNumeros(this)">
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" id="celular" name="celular" class="form-control" value="" placeholder="Número de 9 digitos.">
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
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </form>
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
