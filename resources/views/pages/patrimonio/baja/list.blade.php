@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Baja de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>

<script src="{{ asset('js/baja/bajaReporte.js') }}"></script>
<script src="{{ asset('js/buscador.js') }}"></script>

<div class="container">
    <main>
        <h1>Baja de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información del Cargo</legend>
            </div>
            <div class="card-body">
                <div class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start">
                    <div class="m-1 px-5 pb-1 pt-2">
                        <label for="buscador" class="form-label">Buscar Cargo de Baja:</label>
                        <input type="text" id="buscador" name="buscador" class="form-control" value=""
                            placeholder="Buscar Baja por CÓDIGO o PERSONAL que registró..." data-table="#tablaBaja">
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ route('bajas.create') }}'">Generar Oficio de Baja</button>
                        </div>
                    </div>
                </div>
                <!-- Tabla de informacion -->
                <div class="table-responsive  shadow p-3 bg-body rounded mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código Baja</th>
                                <th>Fecha</th>
                                <th>Observacion</th>
                                <th>Personal</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaBaja">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection