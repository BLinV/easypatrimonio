document.addEventListener('DOMContentLoaded', function () {
    const origenSelect = document.getElementById('origen');
    const otroOrigenContainer = document.getElementById('otroorigen-container');

    origenSelect.addEventListener('change', function () {
        if (origenSelect.value === '4') {
            otroOrigenContainer.style.display = 'block';
        } else {
            otroOrigenContainer.style.display = 'none';
        }
    });

    const servicioSelect = document.getElementById('servicio');
    servicioSelect.addEventListener('change', function () {
        if (servicioSelect.value == "") {
            $('#personal').html(`<option value="">.: Seleccionar :.</option>`);
        } else {
            $.ajax({
                type: "get",
                url: "/api/informacion_personalBuscar/" + servicioSelect.value,
                data: false,
                dataType: "json",
                contentType: "application/json",
                processData: false,
                success: function (response) {
                    if (response.exito) {
                        let personal = `<option value="">.: Seleccionar :.</option>`
                        let maxIdPersonal = null;
                        if (response._personal.length > 0) {
                            maxIdPersonal = response._personal.reduce((max, element) =>
                                element.IdPersonal > max ? element.IdPersonal : max, response._personal[0].IdPersonal);
                            response._personal.forEach(element => {
                                personal += `<option value=${element.IdPersonal}>${element.Personal}</option>`
                            });
                        }
                        $('#personal').html(personal);
                        $('#personal').attr({ 'disabled': false })
                        if (maxIdPersonal !== null) {
                            $('#personal').val(maxIdPersonal);
                        }
                    }
                },
                error: function (xhr) {
                    LoadingOverlay(false);
                    let errorMsg = 'Error en la validación.';
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        errorMsg = '';
                        for (let field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                errorMsg += `+ ${errors[field][0]} <br/>`;
                            }
                        }
                    } else if (xhr.response?.mensajeError) {
                        errorMsg = xhr.response.mensajeError;
                    }
                    Alertas('Error', errorMsg, 'error');
                }
            });
        }
    });
});

function obtenerTextoOption(selectId, value) {
    const select = document.getElementById(selectId);
    const options = select.options;
    for (const element of options) {
        if (element.value === value) {
            return element.text;
        }
    }
    return null;
}

function IniciarTramite() {
    let numerointerno = document.getElementById('numerointerno').value;
    if (numerointerno !== "" && numerointerno.length==10) {
        $.ajax({
            type: "get",
            url: `/api/informacion_ingreso/${numerointerno}`,
            dataType: "json",
            success: function (response) {
                //Validación de campo
                if (response._ingreso != null) {
                    $('#numeropecosa').val(response._ingreso.NumeroPecosa);
                    $('#origen').val(response._ingreso.IdOrigen);
                    $('#otroorigen').text(response._ingreso.OtroOrigen);
                    $('#observacion').text(response._ingreso.Observacion);
                    CargarDetalle();
                    bloquearFormularioIngreso(true);
                } else {
                    Alertas('Información', 'Se esta ingresando una nueva PECOSA.', 'info')
                    bloquearFormularioIngreso(false);
                }
                $('#numerointerno').attr({ 'disabled': true });
                $('#btnTramitar').attr({ 'disabled': true });
                bloquearFormularioPatrimonio(false);
            },
            error: function (xhr) {
                LoadingOverlay(false);
                let errorMsg = 'Error en la validación.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `+ ${errors[field][0]} <br/>`;
                        }
                    }
                } else if (xhr.response?.mensajeError) {
                    errorMsg = xhr.response.mensajeError;
                }
                Alertas('Error', errorMsg, 'error');
            }
        });
    } else {
        $.ajax({
            type: "get",
            url: "/api/generar_codigoingreso",
            dataType: "json",
            success: function (response) {
                if (response.exito) {
                    Alertas('Información', 'Se esta ingresando una nueva PECOSA.', 'info')
                    $('#numerointerno').val(response._codigo);
                    $('#numerointerno').attr({ 'disabled': true });
                    $('#btnTramitar').attr({ 'disabled': true });
                    bloquearFormularioIngreso(false);
                    bloquearFormularioPatrimonio(false);
                } else {
                    alert('Error al generar el código: ' + response.mensajeError);
                }
            },
            error: function (xhr) {
                LoadingOverlay(false);
                let errorMsg = 'Error en la validación.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `+ ${errors[field][0]} <br/>`;
                        }
                    }
                } else if (xhr.response?.mensajeError) {
                    errorMsg = xhr.response.mensajeError;
                }
                Alertas('Error', errorMsg, 'error');
            }
        });
    }
}

function bloquearFormularioIngreso(bool) {
    $('#numeropecosa').attr({ 'disabled': bool });
    $('#origen').attr({ 'disabled': bool });
    $('#otroorigen').attr({ 'disabled': bool });
    $('#observacion').attr({ 'disabled': bool });
}

function bloquearFormularioPatrimonio(bool) {
    $('#codutes').attr({ 'disabled': bool });
    $('#codservicio').attr({ 'disabled': bool });
    $('#servicio').attr({ 'disabled': bool });
    $('#tipo').attr({ 'disabled': bool });
    $('#marca').attr({ 'disabled': bool });
    $('#modelo').attr({ 'disabled': bool });
    $('#categoria').attr({ 'disabled': bool });
    $('#comentario').attr({ 'disabled': bool });
    $('#estado').attr({ 'disabled': bool });
    $('.registro').attr({ 'disabled': bool });
}

function CargarDetalle() {
    let numerointerno = document.getElementById('numerointerno').value;
    $('#dt-search-0').addClass('pb-2');
    if (!$.fn.DataTable.isDataTable('#tablaIngreso')) {
        datatable = new DataTable('#tablaIngreso', {
            'responsive': true,
            'lengthChange': false,
            'autoWidth': false,
            'scrollCollapse': true,
            'scroller': true,
            ajax: {
                url: '/api/informacion_ingresodetalle/' + numerointerno,
                type: 'get',
                dataType: 'json',
                dataSrc: "_detalleingreso"
            },
            columns: [
                { data: 'CodInterno' },
                { data: 'CodUTES' },
                { data: 'CodServicio' },
                { data: 'Articulo' },
                { data: 'Descripcion' },
                { data: 'Estado' },
                { data: 'Servicio' },
                { data: 'Categoria' },
                {
                    data: null,
                    render: function (param) {
                        return `<div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-info" type="button" data-codinterno="${param['CodInterno']}" onClick="Editar(this)">Editar</button>
                                </div>`
                    }
                }],
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf'],
            pageLength: 10,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    } else {
        datatable.ajax.reload();
    }
}

function GuardarIngreso() {
    // Informacion PECOSA
    let numerointerno = document.getElementById('numerointerno').value;
    let numeropecosa = document.getElementById('numeropecosa').value;
    let origen = document.getElementById('origen').value;
    let otroorigen = document.getElementById('otroorigen').value;
    let observacion = document.getElementById('observacion').value;

    let idpersonal = personal.IdPersonal; // Acceder a IdPersonal desde el objeto personal

    //Informacion Patrimonio
    let codutes = document.getElementById('codutes').value;
    let codservicio = document.getElementById('codservicio').value;
    let tipo = document.getElementById('tipo').value;
    let marca = document.getElementById('marca').value;
    let modelo = document.getElementById('modelo').value;
    let categoria = document.getElementById('categoria').value;
    let servicio_id = document.getElementById('servicio').value;
    let comentario = document.getElementById('comentario').value;
    let estado = document.getElementById('estado').value;

    let idencargado = document.getElementById('personal').value;
    let motivo = "Registrado";

    var ingreso = {
        "NumeroInterno": numerointerno,
        "NumeroPecosa": numeropecosa,
        "IdOrigen": origen,
        "OtroOrigen": otroorigen,
        "Observacion": observacion,
        "IdPersonal": idpersonal,

        "CodUTES": codutes,
        "CodServicio": codservicio,
        "tipo_descripcion": tipo,
        "marca_descripcion": marca,
        "Modelo": modelo,
        "Descripcion": comentario,
        "categoria_descripcion": categoria,
        "IdServicio": servicio_id,

        "Estado": estado,
        "IdEncargado": idencargado,
        "Motivo": motivo
    };
    //Ubicacion

    if ($('#metodoFormulario').val() == 'POST') {
        $.ajax({
            type: "post",
            url: "/api/registrar_ingreso",
            data: JSON.stringify(ingreso),
            dataType: "json",
            contentType: "application/json",
            processData: false,
            success: function (response) {
                LoadingOverlay(false);
                if (response.exito) {
                    Alertas('Confirmación', response.mensaje, 'success');
                    bloquearFormularioIngreso(true);
                    Limpiar();
                    CargarDetalle();
                } else {
                    Alertas('Error', response.mensaje + " " + response.mensajeError, 'error');
                }
            },
            error: function (xhr) {
                LoadingOverlay(false);
                let errorMsg = 'Error en la validación.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `+ ${errors[field][0]} <br/>`;
                        }
                    }
                } else if (xhr.response?.mensajeError) {
                    errorMsg = xhr.response.mensajeError;
                }
                Alertas('Error', errorMsg, 'error');
            },
            beforeSend: function () {
                LoadingOverlay(true);
            }
        });
    } else {
        $.ajax({
            type: "put",
            url: "/api/actualizar_patrimonio/" + $('#codinterno').text(),
            data: JSON.stringify(ingreso),
            dataType: "json",
            contentType: 'application/json',
            processData: false,
            success: function (response) {
                LoadingOverlay(false);

                if (response.exito) {
                    Alertas('Confirmación', response.mensaje, 'success');
                    bloquearFormularioIngreso(true);
                    Limpiar();
                    CargarDetalle();
                } else {
                    Alertas('Error', response.mensajeError, 'error');
                }
            },
            error: function (xhr) {
                LoadingOverlay(false);
                let errorMsg = 'Error al actualizar el Patrimonio.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `+ ${errors[field][0]} <br/>`;
                        }
                    }
                } else if (xhr.responseJSON?.mensajeError) {
                    errorMsg = xhr.responseJSON.mensajeError;
                }
                Alertas('Error', errorMsg, 'error');
            },
            beforeSend: function () {
                LoadingOverlay(true);
            }
        });
    }
}

function Limpiar() {
    if ($('.registro').hasClass('btn-warning')) {
        $('.registro').removeClass('btn-warning');
        $('.registro').addClass('btn-primary');
        $('.registro').text('Registrar');
    }
    $('#metodoFormulario').val('POST');

    $('#codutes').attr({ 'disabled': false });
    $('#codutes').val('');

    $('#codinterno').text('');

    $('#codservicio').val('');
    $('#servicio').attr({ 'disabled': false });
    $('#servicio').val('');
    $('#tipo').val('');
    $('#marca').val('');
    $('#modelo').val('');
    $('#patrimonio').val('');
    $('#categoria').val('');
    $('#comentario').val('');
    $('#estado').val('');

    $('#personal').val('');
    $('#personal').html(`<option value="">.: Seleccionar :.</option>`);
    $('#personal').attr({ 'disabled': true });
}

function Editar(e) {
    let codinterno = $(e).attr('data-codinterno');
    $.ajax({
        type: "get",
        url: "/api/informacion_ingresopatrimonio/" + codinterno,
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                if ($('.registro').hasClass('btn-primary')) {
                    $('.registro').removeClass('btn-primary');
                    $('.registro').addClass('btn-warning');
                    $('.registro').text('Actualizar');
                }

                $('#codinterno').text(response._detallepatrimonio['CodInterno']);
                $('#codutes').val(response._detallepatrimonio['CodUTES']);
                $('#codservicio').val(response._detallepatrimonio['CodServicio']);
                $('#servicio').val(response._detallepatrimonio['IdServicio']);
                $('#servicio').attr({ 'disabled': true });
                $('#tipo').val(response._detallepatrimonio['Tipo']);
                $('#marca').val(response._detallepatrimonio['Marca']);
                $('#modelo').val(response._detallepatrimonio['Modelo']);
                $('#patrimonio').val(response._detallepatrimonio['Articulo']);
                $('#categoria').val(response._detallepatrimonio['Categoria']);
                $('#comentario').val(response._detallepatrimonio['Descripcion']);
                $('#estado').val(response._detallepatrimonio['estado']);
                $('#metodoFormulario').val('PUT');
            } else {
                Alertas('Error', response.mensajeError, 'error');
            }
        },
        error: function (xhr) {
            LoadingOverlay(false);
            let errorMsg = 'Error en la validación.';
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                errorMsg = '';
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errorMsg += `+ ${errors[field][0]} <br/>`;
                    }
                }
            } else if (xhr.response?.mensajeError) {
                errorMsg = xhr.response.mensajeError;
            }
            Alertas('Error', errorMsg, 'error');
        }
    });
}