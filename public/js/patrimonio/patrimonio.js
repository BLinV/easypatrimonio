function listarDatosTabla(){
    $.ajax({
        type: "get",
        url: "/api/informacion_patrimonioreporte",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if(response.exito){
                let tabla = ''
                if(response._patrimonio.length > 0){              //Tabla informacion personal
                    response._patrimonio.forEach(element => {
                        tabla += `<tr class="option-table" data-filter="${element.CodUTES} ${element.CodInterno} ${element.Articulo.toUpperCase()}">
                        <td>${element.CodUTES}</td><td>${element.CodInterno}</td><td>${element.Articulo}</td><td>${element.Servicio}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a class="dropdown-item" onClick="ver('${element.CodUTES}')" data-id="${element.CodUTES}">Ver</a></li>
                                    <li><a class="dropdown-item" href="#">Actualizar</a></li>
                                </ul>
                            </div>
                        </td></tr>`
                    });
                } else {
                    tabla += `<tr><td colspan="9">No se encontraron registros.</td></tr>`
                }
                $('#tablaPatrimonio').html(tabla);
            }
        }
    });
}

listarDatosTabla();

function ver(id) {
    $.ajax({
        type: "get",
        url: `/api/detalle_patrimonio/${id}`,
        dataType: "json",
        success: function(response) {
            if(response._detallepatrimonio.length > 0) {
                $('#detalleDescripcion').text(response._detallepatrimonio[0].Descripcion);
                $('#detalleCategoria').text(response._detallepatrimonio[0].Categoria);
                $('#detalleOperativo').html(
                    response._detallepatrimonio[0].Operativo ?
                    `<p class="bg-success text-white p-2 d-inline rounded-pill">Si</p>`:
                    `<p class="bg-danger text-white p-2 d-inline rounded-pill">No</p>`
                );
                $('#detalleBaja').html(response._detallepatrimonio[0].Baja ?
                    `<p class="bg-warning text-white p-2 d-inline rounded-pill">Si</p>`:
                    `<p class="bg-success text-white p-2 d-inline rounded-pill">No</p>`);
                $('#detalleUbicacion').text(response._detallepatrimonio[0].Ubicacion);
                ModalAbrirCerrar('verDetalle', true);
            } else {
                alert('No se pudo obtener el detalle.');
            }
        },
        error: function() {
            alert('Error al obtener el detalle.');
        }
    });
}