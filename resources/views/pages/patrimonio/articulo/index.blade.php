@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>

<script src="{{ asset('js/patrimonio.js') }}"></script>

<div class="container">
    <main>
        <h1>Reporte de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información del Patrimonio:</legend>
            </div>
            <div class="card-body">
                <form class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start" action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="buscar" class="form-label">Buscar en lista:</label>
                            <input type="text" id="buscar" name="buscar" class="form-control" value="" placeholder="Código UTES o código interno">
                        </div>
                    </div>
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