/*Todo lo llena el metodo ListarPersonal()
Proceso: JS llama a API, API llama a Controller, Controller devuelve a API y luego a JS, JS arma HTML
e inyecta a Tabla(ID)*/

function Buscador(e) {
    var buscador = $(e).val()
    console.log(buscador);
    if (buscador == '') {
        $("#tablaPersonal .option-table").show();
    } else {
        $("#tablaPersonal .option-table").hide();
        $("#tablaPersonal .option-table[data-filter\*='" + buscador.toUpperCase() + "']").show();
    }

}

function listarPersonal() {
    $.ajax({
        type: "get",
        url: "/api/informacion_personal",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                let servicio = `<option value="">.: Seleccionar :.</option>`//El modelo de la respuesta de tu API (en web), recuerda: ``->""->''
                if (response._servicio.length > 0) {              //Cbobox Servicio
                    response._servicio.forEach(element => {
                        servicio += `<option value=${element.IdServicio}>${element.Descripcion}</option>`
                    });
                }
                $('#servicio').html(servicio);

                let condicion = `<option value="">.: Seleccionar :.</option>`
                if (response._condicion.length > 0) {             //Cbobox Condicion
                    response._condicion.forEach(element => {
                        condicion += `<option value=${element.IdCondicion}>${element.Descripcion}</option>`
                    });
                }
                $('#condicion').html(condicion);

                let tabla = ''
                if (response._personal.length > 0) {              //Tabla informacion personal
                    response._personal.forEach(element => {
                        tabla += `<tr class="option-table" data-filter="${element.Persona.toUpperCase()}">
                        <td>${element.Dni}</td><td>${element.Persona}</td><td>${element.Celular}</td>
                        <td>${element.Condicion}</td><td>${element.Servicio}</td><td>${element.Estado}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a class="dropdown-item" data-dni="${element.Dni}" onclick="Ver(this)">Actualizar</a></li>
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

function Ver(e) {

}

function validar() {
    let nombre = $('#nombre').val()
    let apellido = $('#apellido').val()
    let dni = $('#dni').val()
    let celular = $('#celular').val()
    let condicion = $('#condicion').val()
    let servicio = $('#servicio').val()

    if (nombre == '') {
        Alertas('Error', 'El nombre es requerido', 'error')
        return false
    }

    if (apellido == '') {
        Alertas('Error', 'El apellido es requerido', 'error')
        return false
    }

    if (dni == '') {
        Alertas('Error', 'El dni es requerido', 'error')
        return false
    }

    if (dni.length < 8) {
        Alertas('Error', 'El dni debe tener 8 caracteres', 'error')
        return false
    }

    if (celular == '') {
        Alertas('Error', 'El celular es requerido', 'error')
        return false
    }

    if (celular.length < 9) {
        Alertas('Error', 'El celular debe tener 9 caracteres', 'error')
        return false
    }

    if (condicion == '') {
        Alertas('Error', 'La condicion es requerido', 'error')
        return false
    }

    if (servicio == '') {
        Alertas('Error', 'El servicio es requerido', 'error')
        return false
    }
    return true
}

const GuardarPersona = () => {
    if (validar()) {
        let nombre = $('#nombre').val()
        let apellido = $('#apellido').val()
        let dni = $('#dni').val()
        let celular = $('#celular').val()
        let condicion = $('#condicion').val()
        let servicio = $('#servicio').val()


        let datos = {
            'nombre': nombre,
            'apellido': apellido,
            'dni': dni,
            'celular': celular,
            'condicion': condicion,
            'servicio': servicio
        }

        $.ajax({
            type: "post",
            url: "api/registrar_personal",
            data: datos,
            dataType: "json",
            contentType: 'application/json',
            processData: false,
            success: function (response) {
                LoadingOverlay(false)

                console.log(response);

            }, beforeSend: function () {
                LoadingOverlay(true)
            }
        });
    }
}