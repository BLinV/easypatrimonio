@csrf
<div class="modal-header">
    <h5 class="modal-title" id="modalLabel">Información del Artículo</h5>
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
                @include('pages.shared.articulo',['vista'=>['articulo'=>false, 'operativo'=>false, 'ubicacion'=>true, 'comentario'=>false, 'boton'=>'Actualizar']])
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