@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Ingreso de Patrimonio')
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
                    <h1>Formulario de Registro de Ingreso de Patrimonio</h1>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off"
                        onsubmit="return GuardarIngreso()">
                        <input type="hidden" name="_method" id="metodoFormulario" value="POST">
                        <div class="row g-2 justify-content-start">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="card-header shadow-sm p-3 mb-3 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información de PECOSA</legend>
                                    </div>

                                    <div id="numerointerno-container" style="display:true;">
                                        <div class="form-group mb-2">
                                            <label for="numerointerno" class="form-label">Código interno del
                                                Documento:</label>
                                            <input type="text" id="numerointerno" name="numerointerno"
                                                class="form-control" value="" placeholder="" maxlength="10">
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="numeropecosa" class="form-label">Código del Documento (PECOSA u
                                            OTRO):</label>
                                        <input type="text" id="numeropecosa" name="numeropecosa" class="form-control"
                                            value="" placeholder="Código de 20 dígitos." maxlength="20" disabled>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="origen" class="form-label">Origen:</label>
                                        <select id="origen" name="origen" class="form-select" disabled>
                                        </select>
                                    </div>
                                    <div id="otroorigen-container" style="display:none;">
                                        <div class="form-group mb-2">
                                            <label for="otroorigen" class="form-label">Nombre del Origen:</label>
                                            <input type="text" id="otroorigen" name="otroorigen" class="form-control"
                                                value="" placeholder="Epecifique el origen del patrimonio." disabled>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="form-group mb-2">
                                            <label for="observacion" class="form-label">Observaciones del patrimonio
                                                recibido:</label>
                                            <textarea type="text" id="observacion" name="observacion" class="form-control" style="" value=""
                                                placeholder="'El palet llegó con abolladuras', 'Articulo [A] no ubicado.'" maxlength="255" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" id = "btnTramitar" class="btn btn-danger me-2"
                                            onclick="IniciarTramite()">Documentar Ingreso</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-6 col-sm-12">
                                <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información de Patrimonio</legend>
                                        <span id="codinterno"></span>
                                    </div>
                                    <div class="row g-3 justify-content-start">
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codutes" class="form-label">Código UTES:</label>
                                                <input type="text" id="codutes" name="codutes" class="form-control"
                                                    value="" placeholder="Código de 12 dígitos." maxlength="12"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codservicio" class="form-label">Código Servicio:</label>
                                                <input type="text" id="codservicio" name="codservicio"
                                                    class="form-control" value=""
                                                    placeholder="Código de máxmo 12 digitos." maxlength="12" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="servicio" class="form-label">Servicio:</label>
                                                <select id="servicio" name="servicio" class="form-select" disabled>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="personal" class="form-label">Personal a cargo:</label>
                                                <select id="personal" name="personal" class="form-select" disabled>
                                                    <option value="">.: Seleccionar :.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <script src="{{ asset('js/autocompletar.js') }}"></script>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="tipo" class="form-label">Tipo:</label>
                                                <input type="text" id="tipo" name="tipo" class="form-control"
                                                    value=""
                                                    placeholder="Monitor/All in One/Estetoscopio/Puloxímetro" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="marca" class="form-label">Marca:</label>
                                                <input type="text" id="marca" name="marca" class="form-control"
                                                    value="" placeholder="HP/Acer/Adesco/ADC" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="modelo" class="form-label">Modelo:</label>
                                                <input type="text" id="modelo" name="modelo" class="form-control"
                                                    value="" placeholder="1800px/Intel Core TM i5/HR digital"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="patrimonio" class="form-label">Articulo: </label>
                                                <input type="text" id="patrimonio" name="patrimonio"
                                                    class="form-control" value=""
                                                    placeholder="Puloxímetro Adesco HR digital" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="categoria" class="form-label">Categoría:</label>
                                                <select id="categoria" name="categoria" class="form-select" disabled>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="comentario" class="form-label">Características del
                                                    Patrimonio:</label>
                                                <textarea type="text" id="comentario" name="comentario" class="form-control" style="resize: none;"
                                                    value="" placeholder="Máximo 250 caracteres." disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-2">
                                            <label for="estado" class="form-label">Información anexa sobre la recepción
                                                del patrimonio:</label>
                                            <textarea type="text" id="estado" name="estado" class="form-control" style="resize: none;" value=""
                                                placeholder="Máximo 250 caracteres." disabled></textarea>
                                        </div>
                                    </div>
                                    <script>
                                        var IdPersonal = localStorage.getItem('IdPersonal');// Recuperar IdPersonal de localStorage
                                    </script>
                                    <div class=" mb-5 mt-2">
                                        <div class="float-end mb-2">
                                            <button type="submit" class="registro btn btn-primary" id="btnFormulario"
                                                disabled>Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaIngreso">
                            <thead>
                                <tr> <!-- Recuerda que DataTable cuenta las columnas que tiene tu tabla -->
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
                        <script src="{{ asset('js/ingreso/formulario.js') }}"></script>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
