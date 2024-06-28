@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>

<script src="{{ asset('js/patrimonio/patrimonio.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>

<div class="container">

    <div class="modal fade" id="verDetalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalle de Patrimonio:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Descripción:</strong> <span id="detalleDescripcion">ssss</span></p>
                    <p><strong>Categoría:</strong> <span id="detalleCategoria"></span></p>
                    <p><strong>Operativo:</strong> <span id="detalleOperativo"></span></p>
                    <p><strong>Baja:</strong> <span id="detalleBaja"></span></p>
                    <p><strong>Ubicación Actual:</strong> <span id="detalleUbicacion"></span></p>
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
                <div class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start">
                    <div class="m-1 px-5 pb-1 pt-2">
                        <label for="buscador" class="form-label">Buscar en lista:</label>
                        <input type="text" id="buscador" name="buscador" class="form-control" value=""
                            placeholder="Buscar Patrimonio por CÓDIGOS o ARTICULO..." data-table="#tablaPatrimonio">
                    </div>
                </div>
                <!-- Tabla de informacion -->
                <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código UTES</th>
                                <th>Código Interno</th>
                                <th>Patrimonio</th>
                                <th>Servicio</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPatrimonio">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection