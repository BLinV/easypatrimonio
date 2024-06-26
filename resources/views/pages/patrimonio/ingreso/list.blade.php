@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Ingreso de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>
<script src="{{ asset('js/origenServicioCategoria.js') }}"></script>
<script src="{{ asset('js/ingreso/ingresoReporte.js') }}"></script>

<div class="container">
    <main>
        <h1>Ingreso de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información de PECOSA</legend>
            </div>
            <div class="card-body">
                <form class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start" action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="codpecosa" class="form-label">Número de PECOSA:</label>
                            <input type="text" id="codpecosa" name="codpecosa" class="form-control" value="" placeholder="Código de 12 dígitos.">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="origen" class="form-label">Origen:</label>
                            <select id="origen" name="origen" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ route('ingresos.create') }}'">Ingresar PECOSA</button>
                        </div>
                    </div>
                </form>
                <!-- Tabla de informacion -->
                <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código PECOSA</th>
                                <th>Patrimonio</th>
                                <th>Origen</th>
                                <th>Comentario</th>
                                <th>Personal</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaIngreso">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection