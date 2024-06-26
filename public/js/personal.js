/*Todo lo llena el metodo ListarPersonal()
Proceso: JS llama a API, API llama a Controller, Controller devuelve a API y luego a JS, JS arma HTML
e inyecta a Tabla(ID)*/
function listarPersonal() {
    $.ajax({
        type: "get",
        url: "/api/informacion_personal",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            console.log(response);
            if(response.exito){
                let servicio = `<option value="">.: Seleccionar :.</option>`//El modelo de la respuesta de tu API (en web), recuerda: ``->""->''
                if(response._servicio.length > 0){              //Cbobox Servicio
                    response._servicio.forEach(element => {
                        servicio += `<option value=${element.IdServicio}>${element.Descripcion}</option>`
                    });
                }
                $('#servicio').html(servicio);

                let condicion = `<option value="">.: Seleccionar :.</option>`
                if(response._condicion.length > 0){             //Cbobox Condicion
                    response._condicion.forEach(element => {
                        condicion += `<option value=${element.IdCondicion}>${element.Descripcion}</option>`
                    });
                }
                $('#condicion').html(condicion);

                let tabla = ''
                if(response._personal.length > 0){              //Tabla informacion personal
                    response._personal.forEach(element => {
                        tabla += `<tr>
                        <td>${element.Dni}</td><td>${element.Persona}</td><td>${element.Celular}</td>
                        <td>${element.Condicion}</td><td>${element.Servicio}</td><td>${element.Estado}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a class="dropdown-item" href="#">Actualizar</a></li>
                                    <li><a class="dropdown-item" href="#">Retirar</a></li>
                                </ul>
                            </div>
                        </td></tr>`
                    });
                } else {
                    tabla += `<tr><td colspan="9">No se encontraron registros.</td></tr>`
                }
                $('#tablaPersonal').html(tabla);
                /*Todo lo llena el metodo ListarPersonal()
                Proceso: JS llama a API, API llama a Controller, Controller devuelve a API y luego a JS, JS arma HTML e inyecta a Tabla(ID)*/
            }
        }
    });
}
listarPersonal();