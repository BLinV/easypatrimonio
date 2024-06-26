@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Baja de Patrimonio')
@section('content')
<script>
    LoadingOverlay(true)
    LoadingOverlay(false)
</script>

<script src="{{ asset('js/baja/bajaReporte.js') }}"></script>

<div class="container">
    <main>
        <h1>Baja de Patrimonio</h1>
        <div class="card">
            <div class="card-header">
                <legend>Información del Cargo</legend>
            </div>
            <div class="card-body">
                <form class="shadow p-3 mb-5 bg-body rounded row g-2 justify-content-start" action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="codoficio" class="form-label">Código de Cargo:</label>
                            <input type="text" id="codoficio" name="codoficio" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="codpatrimonio" class="form-label">Buscar patrimonio:</label>
                            <input type="text" id="codpatrimonio" name="codpatrimonio" class="form-control" value="" placeholder="Código UTES o Interno">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Buscar Oficio de Baja</button>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ route('bajas.create') }}'">Generar Oficio de Baja</button>
                        </div>
                    </div>
                </form>
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