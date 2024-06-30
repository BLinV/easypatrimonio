@extends('layouts.app')
@section('title', 'Sistema de Control Patrimonial - Ingreso de Patrimonio')
@section('content')




    <script src="{{ asset('js/ingreso/formulario.js') }}"></script>
    <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

    <div class="container-fluid">
        <main class="m-3">

            <div class="card">

                <div class="card-header bg-white">
                    <h1>Formulario de Registro de Ingreso de Patrimonio</h1>
                </div>
                <div class="card-body">

                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row g-2 justify-content-start">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="shadow-sm p-3 mb-3 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información de PECOSA</legend>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="codpecosa" class="form-label">Número de PECOSA:</label>
                                        <input type="text" id="codpecosa" name="codpecosa" class="form-control"
                                            value="" placeholder="Código de 12 dígitos." maxlength="12">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="origen" class="form-label">Origen:</label>
                                        <select id="origen" name="origen" class="form-select">
                                        </select>
                                    </div>

                                    <div id="otroorigen-container" style="display:none;">
                                        <div class="form-group mb-2">
                                            <label for="otroorigen" class="form-label">Nombre de Origen:</label>
                                            <input type="text" id="otroorigen" name="otroorigen" class="form-control"
                                                value="" placeholder="Especificar otro origen">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-danger">Mostrar Informacion</button>
                                </div>

                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-6 col-sm-12">
                                <div class="shadow-sm p-3 mb-5 bg-body rounded">
                                    <div class="text-center">
                                        <legend>Información de PECOSA</legend>
                                    </div>

                                    <div class="row g-3 justify-content-start">
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codutes" class="form-label">Código UTES:</label>
                                                <input type="text" id="codutes" name="codutes" class="form-control"
                                                    value="" placeholder="Código de 12 dígitos." maxlength="12">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="codinterno" class="form-label">Código Interno:</label>
                                                <input type="text" id="codinterno" name="codinterno" class="form-control"
                                                    value="" placeholder="Código de máxmo 12 digitos." maxlength="12">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="servicio" class="form-label">Servicio:</label>
                                                <select id="servicio" name="servicio" class="form-select">
                                                </select>
                                            </div>
                                        </div>


                                        <script src="{{ asset('js/autocompletar.js') }}"></script>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="tipo" class="form-label">Tipo:</label>
                                                <input type="text" id="tipo" name="tipo" class="form-control"
                                                    value=""
                                                    placeholder="Monitor/All in One/Estetoscopio/Puloxímetro">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="marca" class="form-label">Marca:</label>
                                                <input type="text" id="marca" name="marca" class="form-control"
                                                    value="" placeholder="HP/Acer/Adesco/ADC">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="modelo" class="form-label">Modelo:</label>
                                                <input type="text" id="modelo" name="modelo" class="form-control"
                                                    value="" placeholder="1800px/Intel Core TM i5/HR digital">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="patrimonio" class="form-label">Articulo: </label>
                                                <input type="text" id="patrimonio" name="patrimonio"
                                                    class="form-control" value=""
                                                    placeholder="Puloxímetro Adesco HR digital" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="categoria" class="form-label">Categoría:</label>
                                                <select id="categoria" name="categoria" class="form-select">
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="comentario" class="form-label">Comentario:</label>
                                                <textarea type="text" id="comentario" name="comentario" class="form-control" style="resize: none;"
                                                    value="" placeholder="Máximo 250 caracteres."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" mb-5 mt-2">
                                        <div class="float-end mb-2">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaIngreso">
                            <thead>
                                <tr>
                                    <th>Código UTES</th>
                                    <th>Código Interno</th>
                                    <th>Patrimonio</th>
                                    <th>Comentario</th>
                                    <th>Categoría</th>
                                    <th>Servicio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script>
        $('#codpecosa').keyup(function(e) {
            var input = $(this).val()

            console.log(input);

            if (input.lenght > 12) {
                console.log('ajax get');
            }
        });
    </script>


@endsection
