@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Baja de Patrimonio')
@section('content')
<div class="container">
    <main>
        <div class="shadow p-3 mb-5 bg-body rounded">
            <h1>Baja de Patrimonio</h1>
            <legend>Información del Cargo</legend>
            <form action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="row g-2 justify-content-start">
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
                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                </div>
                @include('pages.shared.articulo',['vista'=>['tipo'=>false, 'boton'=>'Añadir']])
                <hr/>
                <!-- Tabla de informacion -->
                <div class="table-response">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código UTES</th>
                                <th>Código Interno</th>
                                <th>Patrimonio</th>
                                <th>Comentario</th>
                                <th>Categoría</th>
                                <th>Operativo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123456789ABC</td>
                                <td>123456789ABC</td>
                                <td>Monitor HP 1800px</td>
                                <td>Parpadea</td>
                                <td>Computadoras</td>
                                <td>Operativo</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                            <li><a class="dropdown-item" href="#">Ver</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/Patrimonio') }}">Actualizar</a></li>
                                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>223456789ABC</td>
                                <td>123456789ABC</td>
                                <td>Esfigmomanómetro aneroide</td>
                                <td>Dañado</td>
                                <td>Equipo medico</td>
                                <td>No Operativo</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                            <li><a class="dropdown-item" href="#">Ver</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/Patrimonio') }}">Actualizar</a></li>
                                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9">No se encontraron registros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-grid gap-2  d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection