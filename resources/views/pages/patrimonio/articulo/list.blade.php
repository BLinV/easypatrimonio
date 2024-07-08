@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.min.css">

    <!-- Crear, leer y editar archivos ZIP, permitir exportación de tabla a Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Crear PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <!-- Fuentes para el PDF -->
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

    <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

    <div class="container">
        <div class="container">
            <div class="modal fade" id="verDetalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detalle de Patrimonio:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 justify-content-start">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <p><strong>Codigo Documento Ingreso:</strong> <span id="ingresoDocumento"> No
                                            encontrado. </span></p>
                                    <p><strong>Codugo Interno Ingreso:</strong> <span id="ingresoIngreso"> No encontrado.
                                        </span></p>
                                    <p><strong>Fecha Ingreso:</strong> <span id="ingresoFecha"> No encontrado. </span></p>
                                    <p><strong>Estado Origen:</strong> <span id="ingresoEstado"> No encontrado. </span></p>
                                    <p><strong>Origen:</strong> <span id="ingresoOrigen"> No encontrado. </span></p>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <p><strong>Documento Baja:</strong> <span id="bajaDocumento"> No encontrado. </span></p>
                                    <p><strong>Fecha Baja:</strong> <span id="bajaFecha"> No encontrado. </span></p>
                                    <p><strong>Estado Origen:</strong> <span id="bajaEstado"> No encontrado. </span></p>
                                    <p><strong>Ubicación Actual:</strong> <span id="ubicacionActual"> No encontrado. </span>
                                    </p>
                                </div>
                            </div>
                            <form action="javascript:void(0)" method="post" enctype="multipart/form-data"
                                autocomplete="off" onsubmit="return GuardarMovimiento()">
                                <div class="row g-2 justify-content-start">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <div class="card-header shadow-sm p-3 mb-3 bg-body rounded">
                                            <div class="text-center">
                                                <legend>Información de Movimiento</legend>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="servicio" class="form-label">Servicio:</label>
                                                <select id="servicio" name="servicio" class="form-select">
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="personal" class="form-label">Personal a cargo:</label>
                                                <select id="personal" name="personal" class="form-select">
                                                    <option value="">.: Seleccionar :.</option>
                                                </select>
                                            </div>
                                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="motivo" class="form-label">Motivo:</label>
                                                    <textarea type="text" id="motivo" name="motivo" class="form-control" style="resize: none;" value=""
                                                        placeholder="Máximo 250 caracteres."></textarea>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-danger me-2">Registrar
                                                    movimiento</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-6 col-sm-12">
                                        <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                            <div class="text-center">
                                                <legend>Información de los Movimientos</legend>
                                            </div>
                                            <div class="row g-3 justify-content-start">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Servicio</th>
                                                                <th>Personal</th>
                                                                <th>Motivo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablaDetalle"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                <h1>Reporte de Patrimonio</h1>
                <div class="card">
                    <div class="card-header">
                        <legend>Información del Patrimonio:</legend>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de informacion -->
                        <div class="table-responsive">
                            <table class="table" id="tablaPatrimonio">
                                <thead>
                                    <tr>
                                        <th>Código UTES</th>
                                        <th>Código Interno</th>
                                        <th>Patrimonio</th>
                                        <th>Servicio</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Operativo</th>
                                        <th>Baja</th>
                                        <th>Ubicación</th>
                                    </tr>
                                </thead>
                            </table>
                            <script src="{{ asset('js/articulo/list.js') }}"></script>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endsection
