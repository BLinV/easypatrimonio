@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Ingreso de Patrimonio')
@section('content')




    <script src="{{ asset('js/ingreso/formulario.js') }}"></script>
    <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

    <div class="container">
        <main>
            <h1>Formulario de Registro de Ingreso de Patrimonio</h1>
            <div class="card">
                <form id="formIngresoPatrimonio">
                    <div class="card-header">
                        <legend>Información de PECOSA</legend>
                    </div>
                    <div class="card-body">
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
                                    <select id="origen" name="origen" class="form-select">
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
                    </div>
                    @include('pages.shared.articulo', [
                        'vista' => [
                            'articulo' => true,
                            'operativo' => false,
                            'ubicacion' => false,
                            'comentario' => true,
                            'boton' => 'Añadir',
                        ],
                    ])
                <div class="shadow p-3 bg-body rounded">
                    <!-- Tabla de informacion -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                <tr>
                                    <td>1234asdasd9ABC</td>
                                    <td>123456789ABC</td>
                                    <td>Monitor HP 1800px</td>
                                    <td>Operativo</td>
                                    <td>Vigilancia</td>
                                    <td>Vigilancia</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                                <li><a class="dropdown-item" href="{{ url('/Patrimonio') }}">Modificar</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="form-group gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </main>
    </div>
@endsection
