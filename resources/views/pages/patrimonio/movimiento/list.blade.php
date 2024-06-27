@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
    <script>
        LoadingOverlay(true)
        LoadingOverlay(false)
    </script>

    <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>
    <script src="{{ asset('js/movimiento/movimiento.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>

    <div class="container">


        <div class="modal fade" id="verMovimiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <main>
            <h1>Movimiento del Patrimonio</h1>
            <div class="card">
                <div class="card-header">
                    <legend>Información de Patrimonio</legend>
                </div>
                <div class="card-body">
                    <div class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start">
                        <div class="m-1 px-5 pb-1 pt-2">
                            <label for="buscador" class="form-label">Buscar en lista:</label>
                            <input type="text" id="buscador" name="buscador" class="form-control" value=""
                                placeholder="Buscar Patrimonio por CODIGO, ARTICULO, CATEGORIA o SERVICIO..." data-table="#tablaMovimiento">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                    </div>
                    <!-- Tabla de informacion -->
                    <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Código UTES</th>
                                    <th>Código Interno</th>
                                    <th>Patrimonio</th>
                                    <th>Comentario</th>
                                    <th>Categoría</th>
                                    <th>Operativo</th>
                                    <th>Servicio</th>
                                    <th>Ubicacion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaMovimiento">
                                <tr>
                                    <td>123456789ABC</td>
                                    <td>123456789ABC</td>
                                    <td>Monitor HP 1800px</td>
                                    <td>Parpadea</td>
                                    <td>Computadoras</td>
                                    <td>Operativo</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button"
                                                id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                                <li><a class="dropdown-item" onClick="ver()" data-id="123456789ABC">Ver</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>


@endsection
