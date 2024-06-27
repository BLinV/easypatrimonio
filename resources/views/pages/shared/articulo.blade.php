@csrf
<div class="card p-3 mb-5 bg-body rounded">
    <div class="card-header">
        <h5>Información del Artículo</h5>
    </div>
    <div class="card-body">
        <div class="row g-2 justify-content-start">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group mb-2">
                        <label for="codutes" class="form-label">Código UTES:</label>
                        <input type="text" id="codutes" name="codutes" class="form-control" value="" placeholder="Código de 12 dígitos.">
                    </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group mb-2">
                        <label for="codinterno" class="form-label">Código Interno:</label>
                        <input type="text" id="codinterno" name="codinterno" class="form-control" value="" placeholder="Código de máxmo 12 digitos.">
                    </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group mb-2">
                        <label for="servicio" class="form-label">Servicio:</label>
                        <select id="servicio" name="servicio" class="form-select">
                        </select>
                    </div>
            </div>
            @if ($vista['articulo'])
            <script src="{{ asset('js/autocompletar.js') }}"></script>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" class="form-control" value="" placeholder="Monitor/All in One/Estetoscopio/Puloxímetro">
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="marca" class="form-label">Marca:</label>
                    <input type="text" id="marca" name="marca" class="form-control" value="" placeholder="HP/Acer/Adesco/ADC">
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" class="form-control" value="" placeholder="1800px/Intel Core TM i5/HR digital">
                </div>
            </div>
            @endif
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="form-group mb-2">
                    <label for="patrimonio" class="form-label">Articulo: </label>
                    <input type="text" id="patrimonio" name="patrimonio" class="form-control" value="" placeholder="Puloxímetro Adesco HR digital" disabled>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select id="categoria" name="categoria" class="form-select">
                    </select>
                </div>
            </div>
            @if ($vista['operativo'])
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="operativo" class="form-label">Operativo:</label>
                    <select id="operativo" name="operativo" class="form-select">
                        <option value="">.: Seleccionar :.</option>
                        <option value=1>Operativo</option>
                        <option value=0>No Operativo</option>
                    </select>
                </div>
            </div>
            @endif
            @if ($vista['ubicacion'])
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="form-group mb-2">
                    <label for="ubicacion" class="form-label">Ubicacion:</label>
                    <select id="ubicacion" name="ubicacion" class="form-select">
                    </select>
                </div>
            </div>
            @endif
            @if ($vista['comentario'])
            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12">
                <div class="form-group mb-2">
                    <label for="comentario" class="form-label">Comentario:</label>
                    <textarea type="text" id="comentario" name="comentario" class="form-control" style="resize: none;" value="" placeholder="Máximo 250 caracteres."></textarea>
                </div>
            </div>
            @endif
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 d-flex justify-content-center align-items-center">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block">{{ $vista['boton'] }}</button>
                </div>
            </div>
        </div>
    </div>
</div>