@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Ingreso de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>
<script src="{{ asset('js/origenServicioCategoria.js') }}"></script>
<script src="{{ asset('js/ingreso/ingresoReporte.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>

<div class="container">
    <main>
        <h1>Ingreso de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información de PECOSA</legend>
            </div>
            <div class="card-body">
                <div class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start">
                    <div class="m-1 px-5 pb-1 pt-2">
                        <label for="buscador" class="form-label">Buscar en lista:</label>
                        <input type="text" id="buscador" name="buscador" class="form-control" value=""
                            placeholder="Buscar Patrimonio por CODIGO, ARTICULO u ORIGEN..." data-table="#tablaIngreso">
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ route('ingresos.create') }}'">Ingresar PECOSA</button>
                        </div>
                    </div>
                </div>
                <!-- Tabla de informacion -->
                <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código PECOSA</th>
                                <th>Fecha</th>
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