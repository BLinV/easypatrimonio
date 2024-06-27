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
    <main>
        <h1>Reporte de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información del Patrimonio:</legend>
            </div>
            <div class="card-body">
                <div class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="estado" class="form-label">Filtrar por Estado:</label>
                            <select id="estado" name="estado" class="form-select">
                                <option value="">.: Seleccionar :.</option>
                                <option value=1>Operativo</option>
                                <option value=0>No Operativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="baja" class="form-label">Filtrar por Posesión:</label>
                            <select id="baja" name="baja" class="form-select">
                                <option value="">.: Seleccionar :.</option>
                                <option value=0>No baja</option>
                                <option value=1>De baja</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Tabla de informacion -->
                <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                    <div class="m-1 px-5 pb-1 pt-2">
                        <label for="buscador" class="form-label">Buscar en lista:</label>
                        <input type="text" id="buscador" name="buscador" class="form-control" value=""
                            placeholder="Buscar Patrimonio por CÓDIGOS o ARTICULO..." data-table="#tablaPatrimonio">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código UTES</th>
                                <th>Código Interno</th>
                                <th>Patrimonio</th>
                                <th>Comentario</th>
                                <th>Categoría</th>
                                <th>Operativo</th>
                                <th>Baja</th>
                                <th>Servicio</th>
                                <!--th>Ubicación</th-->
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