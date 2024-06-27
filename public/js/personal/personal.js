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
                        tabla += `<tr class="option-table" data-filter="${element.Persona.toUpperCase()} ${element.Dni}">
                        <td>${element.Dni}</td><td>${element.Persona}</td><td>${element.Celular}</td>
                        <td>${element.Condicion}</td><td>${element.Servicio}</td>
                        <td>`
                        if (element.Estado == 1) {
                            tabla += `<p class="bg-success text-white p-2 d-inline rounded-pill">Activo</p>`
                        } else {
                            tabla += `<p class="bg-danger text-white p-2 d-inline rounded-pill">Inactivo</p>`
                        }
                        tabla += `</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-dni="${element.Dni}" onclick="Ver(this)">Ver</a></li>    
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-dni="${element.Dni}" onclick="Editar(this)">Editar</a></li>
                                    <li><a style="cursor: pointer;" class="dropdown-item" href="#">Retirar</a></li>
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

listarPersonal()

function Editar(e) {
    let dni = $(e).attr('data-dni')
    $.ajax({
        type: "get",
        url: "/api/buscar_personal/" + dni,
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                if (response._persona.length > 0) {


                    if ($('.registro').hasClass('btn-primary')) {
                        $('.registro').removeClass('btn-primary');
                        $('.registro').addClass('btn-warning');
                        $('.registro').text('Actualizar')
                    }

                    response._persona.forEach(element => {
                        $('#dni').attr({ 'disabled': true })
                        $('#nombre').val(element['Nombres'])
                        $('#apellido').val(element['Apellidos'])
                        $('#dni').val(element['Dni'])
                        $('#celular').val(element['Celular'])
                        $('#condicion').val(element['IdCondicion'])
                        $('#servicio').val(element['IdServicio'])
                    });
                }
            } else {
                Alertas('Error', response.mensajeError, 'error')
            }
        }, error: function (error) {
            console.log(error);
        }, before: function () {

        }
    });
}

function Ver(e) {
    let dni = $(e).attr('data-dni')
    $.ajax({
        type: "get",
        url: "/api/buscar_personal/" + dni,
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                if (response._personal.length > 0) {
                    response._personal.forEach(element => {
                        let informacion = `
                                Personal: ${element['Persona']}
                                Documento: ${element['Dni']}
                                Celular: ${element['Celular']}
                                Condicion: ${element['Condicion']}
                                Servicio: ${element['Servicio']}
                                Estado: ${element['Esatado'] = 1 ? 'Activo' : 'Inactivo'}
                                `

                        Alertas('Información', informacion, 'info')
                    });
                }
            } else {
                Alertas('Error', response.mensajeError, 'error')
            }
        }, error: function (error) {
            console.log(error);
        }, before: function () {

        }
    });
}

function Limpiar() {

    if ($('.registro').hasClass('btn-warning')) {
        $('.registro').removeClass('btn-warning');
        $('.registro').addClass('btn-primary');
        $('.registro').text('Registrar')
    }

    $('#dni').attr({ 'disabled': false })
    $('#nombre').val('')
    $('#apellido').val('')
    $('#dni').val('')
    $('#celular').val('')
    $('#condicion').val('')
    $('#servicio').val('')
}

const GuardarPersona = () => {
    let nombre = $('#nombre').val()
    let apellido = $('#apellido').val()
    let dni = $('#dni').val()
    let celular = $('#celular').val()
    let condicion = $('#condicion').val()
    let servicio = $('#servicio').val()


    let datos = {
        "nombre": nombre,
        "apellido": apellido,
        "dni": dni,
        "celular": celular,
        "condicion": condicion,
        "servicio": servicio
    }

    if (!$('#dni').prop('disabled')) {
        $.ajax({
            type: "post",
            url: "/api/registrar_personal",
            data: JSON.stringify(datos),
            dataType: "json",
            contentType: 'application/json',
            processData: false,
            success: function (response) {
                LoadingOverlay(false)

                if (response.exito) {
                    Alertas('Confirmación', response.mensaje, 'success')
                    Limpiar()
                    listarPersonal()
                } else {
                    Alertas('Error', response.mensajeError, 'error')
                }

            },
            error: function (xhr) {
                LoadingOverlay(false);

                console.log(xhr);

                let errorMsg = 'Error al registrar la persona.';

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `${errors[field][0]}`;
                        }
                    }
                } else if (xhr.responseJSON?.mensajeError) {
                    errorMsg = xhr.responseJSON.mensajeError;
                }

                Alertas('Error', errorMsg, 'error');
            },
            beforeSend: function () {
                LoadingOverlay(true)
            }
        });
    }
}