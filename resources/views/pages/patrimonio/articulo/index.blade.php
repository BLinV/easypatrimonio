@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Reporte de Patrimonio')
@section('content')
    <div class="container">
        <main>
            <h1>Reporte de Patrimonio</h1>
            <div class="shadow p-3 mb-5 bg-body rounded">
                <div class="row g-2 justify-content-start">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="buscar" class="form-label">Buscar en lista:</label>
                            <input type="text" id="buscar" name="buscar" class="form-control" value="" placeholder="Código UTES o código interno">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="estado" class="form-label">Filtrar por Estado:</label>
                            <select id="estado" name="estado" class="form-select">
                                <option value="">.: Seleccionar :.</option>
                                <option value=1>Operativo</option>
                                <option value=0>No Operativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="baja" class="form-label">Filtrar por Posesión:</label>
                            <select id="baja" name="baja" class="form-select">
                                <option value="">.: Seleccionar :.</option>
                                <option value=0>No baja</option>
                                <option value=1>De baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                </div>
                <hr/>
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
                                <th>Operativo</th>
                                <th>Baja</th>
                                <th>Servicio</th>
                                <!--th>Ubicación</th-->
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPatrimonio">
                        </tbody>
                        <script src="{{ asset('js/patrimonio.js') }}"></script>
                    </table>
                </div>
            </div>
        </main>
    </div>
@endsection