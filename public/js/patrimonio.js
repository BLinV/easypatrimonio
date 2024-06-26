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
                        tabla += `<tr>
                        <td>${element.CodUTES}</td><td>${element.CodInterno}</td><td>${element.Articulo}</td>
                        <td>${element.Descripcion}</td><td>${element.Categoria}</td><td>${element.Operativo}</td><td>${element.Baja}</td>
                        <td></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a class="dropdown-item" href="#">Ver</a></li>
                                    <li><a class="dropdown-item" href="{{ route('actualizar.index') }}">Actualizar</a></li>
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