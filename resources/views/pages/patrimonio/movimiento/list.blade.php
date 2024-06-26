@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>

<script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

<div class="container">
    <main>
        <h1>Movimiento del Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información de Patrimonio</legend>
            </div>
            <div class="card-body">
                <form class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start" action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="codpecosa" class="form-label">Buscar en lista:</label>
                            <input type="text" id="codpecosa" name="codpecosa" class="form-control" value="" placeholder="UTES o Interno.">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="ubicacion" class="form-label">Filtrar por Ubicacion:</label>
                            <select id="ubicacion" name="ubicacion" class="form-select"></select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </form>
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
                                            <li><a class="dropdown-item ver-btn" data-id="123456789ABC" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver</a></li>
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                @include('pages.shared.movimiento')
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/modal.js') }}"></script>
@endsection

@section('style')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection
