@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Baja de Patrimonio')
@section('content')

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

    <div class="container-fluid">
        <main class="m-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h1>Formulario de Registro de Baja de Patrimonio</h1>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off"
                        onsubmit="return GuardarBaja()">
                        <div class="row g-2 justify-content-start">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="card-header shadow-sm p-3 mb-3 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información del Cargo</legend>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="codbaja" class="form-label">Código de Cargo:</label>
                                        <input type="text" id="codbaja" name="codbaja" class="form-control"
                                            value="" placeholder="Código de 20 dígitos." maxlength="20">
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="form-group mb-2">
                                            <label for="observacion" class="form-label">Observacion de la baja:</label>
                                            <textarea type="text" id="observacion" name="observacion" class="form-control" style="resize: none;" value=""
                                                placeholder="Máximo 250 caracteres." disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" id = "btnTramitar" class="btn btn-danger me-2"
                                            onclick="IniciarTramite()">Documentar Baja</button>
                                    </div>
                                </div>
                                <div class="card-header shadow-sm p-3 mb-3 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Buscar Patrimonio</legend>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="codpatrimonio" class="form-label">Buscar patrimonio:</label>
                                        <input type="text" id="codpatrimonio" name="codpatrimonio" class="form-control"
                                            value="" placeholder="Código Interno, UTES o de Servicio" disabled>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" id = "btnBuscar" class="btn btn-danger me-2"
                                            onclick="BuscarPatrimonio()" disabled>Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-6 col-sm-12">
                                <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información de Patrimonio</legend>
                                    </div>
                                    <div class="row g-3 justify-content-start">
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codinterno" class="form-label">Código Interno:</label>
                                                <input type="text" id="codinterno" name="codinterno" class="form-control"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codutes" class="form-label">Código UTES:</label>
                                                <input type="text" id="codutes" name="codutes" class="form-control"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codservicio" class="form-label">Código Servicio:</label>
                                                <input type="text" id="codservicio" name="codservicio" class="form-control"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="servicio" class="form-label">Servicio:</label>
                                                <input type="text" id="servicio" name="servicio" class="form-control"
                                                    disabled>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="patrimonio" class="form-label">Articulo: </label>
                                                <input type="text" id="patrimonio" name="patrimonio"
                                                    class="form-control" value="" placeholder="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="categoria" class="form-label">Categoría:</label>
                                                <input type="text" id="categoria" name="categoria"
                                                    class="form-control" disabled>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="comentario" class="form-label">Características del
                                                    Patrimonio:</label>
                                                <textarea type="text" id="comentario" name="comentario" class="form-control" style="resize: none;" disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="estado" class="form-label">Información anexa sobre la baja del
                                                patrimonio:</label>
                                            <textarea type="text" id="estado" name="estado" class="form-control" style="resize: none;" disabled></textarea>
                                        </div>
                                    </div>

                                    <div class=" mb-5 mt-2">
                                        <div class="float-end mb-2">
                                            <button type="submit" class="registro btn btn-primary" id="btnFormulario"
                                                disabled>Registrar</button>
                                        </div>
                                        <div class="float-end mb-2">
                                            <button type="button" id="btnLimpiar" class="btn btn-primary"
                                                onclick="Limpiar()" disabled>Limpiar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaBaja">
                            <thead>
                                <tr>
                                    <th>Código Interno</th>
                                    <th>Código UTES</th>
                                    <th>Código Servicio</th>
                                    <th>Patrimonio</th>
                                    <th>Caracteristicas</th>
                                    <th>Información Anexa</th>
                                    <th>Servicio</th>
                                    <th>Categoría</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        </table>
                        <script src="{{ asset('js/baja/formulario.js') }}"></script>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
