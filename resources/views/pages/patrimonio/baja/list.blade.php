@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Baja de Patrimonio')
@section('content')
    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css">

    <!-- Calendario -->
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Crear, leer y editar archivos ZIP, permitir exportación de tabla a Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Crear PDF y Fuentes para el PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- Integrar estilos de Bootstrap a DataTable - declaración de DataTable("", {})-->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <!-- Funcionalidad de botones, como exportar en pdf o excel -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <!-- Adaptador de estilo con Bootstrap -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
    <!-- Mostrar y ocultar columnas específicas de tabla -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
    <!-- Exportar tabla en diferentes formatos -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <!-- Imprimir tabla -->
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <!-- Soporte para tabla responsiva -->
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>


    <div class="container-fluid">
        <div class="modal fade" id="verDetalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Detalle de Patrimonio:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table" id="tablaDetalle">
                                <thead>
                                    <tr>
                                        <th>Codigo Interno</th>
                                        <th>Codigo UTES</th>
                                        <th>Codigo Servicio</th>
                                        <th>Artículo</th>
                                        <th>Servicio</th>
                                        <th>Categoría</th>
                                        <th>Descripción</th>
                                        <th>Información Anexa</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="shadow p-3 mt-2 mb-4 rounded-5">
            <h1 class="text-center">Baja de Patrimonio</h1>
            <hr class="border border-dark">

            <div class="d-flex justify-content-between">
                <h4>Información del Cargo</h4>
                <button type="button" class="btn btn-primary text-end"
                    onclick="location.href='{{ route('bajas.create') }}'">Generar
                    Oficio de Baja</button>

            </div>


            <div class="d-flex justify-content-between">
                <div class="">
                    <label for="rangoFecha">Rango de Fechas:</label>
                    <div class="d-flex">
                        <input type="text" id="rangoFecha" class="form-control shadow-none me-2">
                        <button type="button" class="btn btn-primary" id="btnFiltrar">Filtrar</button>
                    </div>

                </div>
                <div class="">
                    <label for="buscar">Buscar:</label>
                    <input type="text" id="buscar" class="form-control shadow-none" placeholder="Buscar...">
                </div>
            </div>


            <div class="card mt-2">
                <div class="card-body">
                    <!-- Tabla de informacion -->
                    <div class="table-responsive">
                        <table class="table" id="tablaBaja">
                            <thead>
                                <tr>
                                    <th>Código Baja</th>
                                    <th>Fecha</th>
                                    <th>Observacion</th>
                                    <th>Personal</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        </table>
                        <script src="{{ asset('js/export/icono_hospital_base64.js') }}"></script>
                        <script src="{{ asset('js/export/export.js') }}"></script>
                        <script src="{{ asset('js/baja/list.js') }}"></script>
                        <script>
                            let personal = JSON.parse(localStorage.getItem('personal')); // Recuperar IdPersonal de localStorage
                        </script>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
