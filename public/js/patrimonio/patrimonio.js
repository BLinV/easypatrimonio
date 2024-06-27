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
                console.log(response)
                if(response._detallePatrimonio.length > 0){              //Tabla informacion personal
                    response._detallePatrimonio.forEach(element => {
                        tabla += `<tr class="option-table" data-filter="${element.CodUTES} ${element.CodInterno} ${element.Articulo.toUpperCase()}">
                        <td>${element.CodUTES}</td><td>${element.CodInterno}</td><td>${element.Articulo}</td>
                        <td>${element.Descripcion}</td><td>${element.Categoria}</td>`
                        if (element.Operativo == 1) {
                            tabla += `<td><p class="bg-success text-white p-2 d-inline rounded-pill">Si</p></td>`
                        } else {
                            tabla += `<td><p class="bg-danger text-white p-2 d-inline rounded-pill">No</p></td>`
                        }
                        if (element.Baja == 1) {
                            tabla += `<td><p class="bg-warning text-white p-2 d-inline rounded-pill">Si</p></td>`
                        } else {
                            tabla += `<td><p class="bg-success text-white p-2 d-inline rounded-pill">No</p></td>`
                        }
                        tabla += `
                        <td>
                        LE SERVICIO
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a class="dropdown-item" href="#">Ver</a></li>
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