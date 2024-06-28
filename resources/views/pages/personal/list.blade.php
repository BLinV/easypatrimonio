@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Personal')
@section('content')

    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">

    <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>




    <script src="{{ asset('js/personal/personal.js') }}"></script>
    
    <div class="container-fluid">
        <main class="m-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h1>Administrar Personal</h1>
                </div>
                <div class="card-body">
                    <div class="row g-3 justify-content-start">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <form action="javascript:void(0)" method="POST" enctype="multipart/form-data"
                                autocomplete="off" onsubmit="return GuardarPersona()">
                                <div class="shadow p-3 mb-2 bg-body rounded row g-2">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="dni" class="form-label">DNI:</label>
                                            <input type="text" id="dni" name="dni" class="form-control"
                                                value="" placeholder="Número de 9 digitos." maxlength="8"
                                                placeholder="Ingrese el n° de identidad"
                                                onkeyup="return ValidarNumeros(this)">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" id="nombre" name="nombre" class="form-control"
                                                value="" onkeyup="return ValidarTexto(this)"
                                                placeholder="Ingrese el nombre">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="apellido" class="form-label">Apellidos:</label>
                                            <input type="text" id="apellido" name="apellido" class="form-control"
                                                value="" onkeyup="return ValidarTexto(this)"
                                                placeholder="Ingrese el apellido">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="celular" class="form-label">Número de Celular:</label>
                                            <input type="text" id="celular" name="celular" class="form-control"
                                                value="" placeholder="Número de 9 digitos." maxlength="9"
                                                placeholder="Ingrese el celular" onkeyup="return ValidarNumeros(this)">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="condicion" class="form-label">Condición:</label>
                                            <select id="condicion" name="condicion" class="form-select">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="servicio" class="form-label">Servicio:</label>
                                            <select id="servicio" name="servicio" class="form-select">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex float-end">
                                        <button type="button" class="btn btn-danger me-2"
                                            onclick="Limpiar()">Limpiar</button>
                                        <button type="submit" class="registro btn btn-primary"
                                            onsubmit="GuardarPersona()">Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="shadow px-3 bg-body rounded p-3">
                                <!-- Tabla de informacion -->
                                <div class="table-responsive">
                                    <table class="table" id="tablaPersonal">
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
                                    </table>

                                    <script src="{{ asset('js/personal/datatable.js') }}"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
