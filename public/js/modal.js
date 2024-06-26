$(document).ready(function(){
    $('.openModalButton').on('click', function(){
        let target = $(this).data('target');
        let content = $('#' + target).html();
        $('#exampleModal.modal-body').html(content);
        $('#exampleModal').modal('show');
    });
});

$(document).ready(function() {
    $('.ver-btn').on('click', function() {
        let patrimonioId = $(this).data('IdPatrimonio');
        $.ajax({
            url: `/api/patrimonio/${patrimonioId}/movimientos`, // Cambia esta URL a la ruta correcta en tu API
            method: 'GET',
            success: function(response) {
                // Suponiendo que response es el JSON con la información del patrimonio
                let contenido = `
                    <p><strong>Artículo:</strong> ${response.articulo}</p>
                    <p><strong>Código UTES:</strong> ${response.codutes}</p>
                    <p><strong>Código Interno:</strong> ${response.codinterno}</p>
                    <p><strong>Categoría:</strong> ${response.categoria}</p>
                    <p><strong>Operativo:</strong> ${response.operativo}</p>
                    <p><strong>Servicio:</strong> ${response.servicio}</p>
                    <h5>Movimientos</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Ubicación Anterior</th>
                                <th>Ubicación Movimiento</th>
                                <th>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>`;
                response.movimientos.forEach(function(movimiento) {
                    contenido += `
                        <tr>
                            <td>${movimiento.fecha}</td>
                            <td>${movimiento.ubicacion_anterior}</td>
                            <td>${movimiento.ubicacion_movimiento}</td>
                            <td>${movimiento.motivo}</td>
                        </tr>`;
                });
                contenido += `
                        </tbody>
                    </table>`;
                
                $('#modal-content-placeholder').html(contenido);
            },
            error: function() {
                alert('Hubo un error al obtener los datos.');
            }
        });
    });
});