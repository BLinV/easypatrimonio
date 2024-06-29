@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Ingreso de Patrimonio')
@section('content')




    <script src="{{ asset('js/ingreso/formulario.js') }}"></script>
    <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

    <div class="container-fluid">
        <main class="m-3">
            
            <div class="card">

                <div class="card-header bg-white">
                    <h1>Formulario de Registro de Ingreso de Patrimonio</h1>
                </div>
                <div class="card-body">

                    <legend>Información de PECOSA</legend>
                    <form id="formIngresoPatrimonio" onsubmit="return registrarIngreso()">
                        <div class="row g-2 justify-content-start">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group mb-2">
                                    <label for="codpecosa" class="form-label">Número de PECOSA:</label>
                                    <input type="text" id="codpecosa" name="codpecosa" class="form-control"
                                        value="" placeholder="Código de 12 dígitos.">
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group mb-2">
                                    <label for="origen" class="form-label">Origen:</label>
                                    <select id="origen" name="origen" class="form-select" disabled>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12" id="otroorigen-container"
                                style="display:none;">
                                <div class="form-group mb-2">
                                    <label for="otroorigen" class="form-label">Nombre de Origen:</label>
                                    <input type="text" id="otroorigen" name="otroorigen" class="form-control"
                                        value="" placeholder="Especificar otro origen">
                                </div>
                            </div>
                            <!--div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                                    <div class="form-group gap-2">
                                        <button type="submit" class="btn btn-primary btn-block">Validar</button>
                                    </div>
                                </div-->
                        </div>
                    </form>
                </div>
                <div id = "ingresoListaPatrimonio" class="shadow p-3 bg-body rounded">
                    @include('pages.shared.articulo', [
                        'vista' => [
                            'articulo' => true,
                            'operativo' => false,
                            'ubicacion' => false,
                            'comentario' => true,
                            'scriptBoton' => 'agregarPatrimonio()',
                            'boton' => 'Añadir',
                        ],
                    ])
                    <!-- Tabla de informacion -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaIngreso">
                            <thead>
                                <tr>
                                    <th>Código UTES</th>
                                    <th>Código Interno</th>
                                    <th>Patrimonio</th>
                                    <th>Comentario</th>
                                    <th>Categoría</th>
                                    <th>Servicio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="form-group gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        $('').keyup(function(e) {

        });
    </script>

@endsection
