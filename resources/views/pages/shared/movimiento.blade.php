@csrf
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información del Artículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!--include('pages.shared.form', [
            'vista' => ['tipo' => true, 'boton' => 'Guardar'],
            'action' => route('articulo.store')
        ])-->
        <div class="card">
            <div class="card-body">
                <div class="row g-2 justify-content-start">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="patrimonio" class="form-label">Articulo: </label>
                            <input type="text" id="patrimonio" name="patrimonio" class="form-control" value="" placeholder="Puloxímetro Adesco HR digital" disabled>
                        </div>
                    </div>
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
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select id="categoria" name="categoria" class="form-select">
                                <option value="seleccionar">Seleccionar</option>
                                <option value="emergencia">Emergencia</option>
                                <option value="nutricion">Nutrición</option>
                                <option value="tuberculosis">Tuberculosis</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="operativo" class="form-label">Operativo:</label>
                            <select id="operativo" name="operativo" class="form-select">
                                <option value="seleccionar">Seleccionar</option>
                                <option value="emergencia">Emergencia</option>
                                <option value="nutricion">Nutrición</option>
                                <option value="tuberculosis">Tuberculosis</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="servicio" class="form-label">Servicio:</label>
                            <select id="servicio" name="servicio" class="form-select">
                                <option value="seleccionar">Seleccionar</option>
                                <option value="emergencia">Emergencia</option>
                                <option value="nutricion">Nutrición</option>
                                <option value="tuberculosis">Tuberculosis</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Ubicación Anterior</th>
                            <th>Ubicación Movimiento</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01/01/2024</td>
                            <td>Vigilancia</td>
                            <td>Tuberculosis</td>
                            <td>Mantenimiento</td>
                        </tr>
                        <tr>
                            <td colspan="4">No se encontraron registros.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>