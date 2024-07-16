function IniciarTramite() {
    let codbaja = document.getElementById('codbaja').value;
    if (codbaja !== "" && codbaja.length==10) {
        $.ajax({
            type: "get",
            url: `/api/informacion_baja/${codbaja}`,
            dataType: "json",
            success: function (response) {
                //Validación de campo
                if (response._baja != null) {
                    $('#observacion').text(response._baja.Observacion);
                    CargarDetalle();
                    $('#observacion').attr({ 'disabled': true })
                } else {
                    Alertas('Información', 'Se esta ingresando un nuevo Oficio de Baja.', 'info')
                    $('#observacion').attr({ 'disabled': false })
                }
                $('#btnTramitar').attr({ 'disabled': true })
                $('#codbaja').attr({ 'disabled': true })

                $('#codpatrimonio').attr({ 'disabled': false })
                $('#btnBuscar').attr({ 'disabled': false })
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
            url: "/api/generar_codigobaja",
            dataType: "json",
            success: function (response) {
                if (response.exito) {
                    Alertas('Información', 'Se esta ingresando un nuevo Oficio de Baja.', 'info')
                    $('#codbaja').val(response._codigo);
                    $('#codbaja').attr({ 'disabled': true })

                    $('#btnTramitar').attr({ 'disabled': false })
                    $('#observacion').attr({ 'disabled': false })

                    $('#codpatrimonio').attr({ 'disabled': false })
                    $('#btnBuscar').attr({ 'disabled': false })
                } else {
                    Alertas('Error', 'Error al generar el código: '+mensajeError, 'error');
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

function CargarDetalle() {
    let codbaja = document.getElementById('codbaja').value;
    $('#dt-search-0').addClass('pb-2');
    if (!$.fn.DataTable.isDataTable('#tablaBaja')) {
        datatable = new DataTable('#tablaBaja', {
            'responsive': true,
            'lengthChange': false,
            'autoWidth': false,
            'scrollCollapse': true,
            'scroller': true,
            ajax: {
                url: '/api/informacion_bajadetalle/' + codbaja,
                type: 'get',
                dataType: 'json',
                dataSrc: "_detallebaja"
            },
            columns: [
                {
                    data: 'CodInterno'
                },
                {
                    data: 'CodUTES'
                },
                {
                    data: 'CodServicio'
                },
                {
                    data: 'Articulo'
                },
                {
                    data: 'Descripcion'
                },
                {
                    data: 'Estado'
                },
                {
                    data: 'Servicio'
                },
                {
                    data: 'Categoria'
                },
                {
                    data: null,
                    render: function (param) {
                        return `<div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-warning" type="button" data-codinterno="${param['CodInterno']}" onClick="Eliminar(this)">Eliminar</button>
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

function BuscarPatrimonio() {
    let codpatrimonio = document.getElementById('codpatrimonio').value;
    $.ajax({
        type: "get",
        url: `/api/informacion_encontrarpatrimonio/${codpatrimonio}`,
        dataType: "json",
        success: function (response) {
            LoadingOverlay(false);
            if (response.exito) {
                $('#codinterno').val(response._detallepatrimonio['CodInterno']);
                $('#codutes').val(response._detallepatrimonio['CodUTES']);
                $('#codservicio').val(response._detallepatrimonio['CodServicio']);
                $('#servicio').val(response._detallepatrimonio['Servicio']);
                $('#patrimonio').val(response._detallepatrimonio['Articulo']);
                $('#categoria').val(response._detallepatrimonio['Categoria']);
                $('#comentario').val(response._detallepatrimonio['Descripcion']);

                $('#codpatrimonio').attr({ 'disabled': true });
                $('#btnBuscar').attr({ 'disabled': true });

                $('#estado').attr({ 'disabled': false });
                $('#btnFormulario').attr({ 'disabled': false });
                $('#btnLimpiar').attr({ 'disabled': false });
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

function GuardarBaja() {
    // Informacion PECOSA
    let codbaja = document.getElementById('codbaja').value;
    let observacion = document.getElementById('observacion').value;
    let idpersonal = 2;

    //Informacion Patrimonio
    let codinterno = document.getElementById('codinterno').value;
    let estado = document.getElementById('estado').value;
    var baja = {
        "CodigoBaja": codbaja,
        "Observacion": observacion,
        "IdPersonal": idpersonal,

        "CodInterno": codinterno,
        "Estado": estado
    };
    $.ajax({
        type: "post",
        url: "/api/registrar_baja",
        data: JSON.stringify(baja),
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            LoadingOverlay(false);
            if (response.exito) {
                Alertas('Confirmación', response.mensaje, 'success');
                $('#observacion').attr({ 'disabled': false });
                Limpiar();
                CargarDetalle();
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

function Limpiar() {
    if ($('.registro').hasClass('btn-warning')) {
        $('.registro').removeClass('btn-warning');
        $('.registro').addClass('btn-primary');
        $('.registro').text('Registrar');
    }
    $('#metodoFormulario').val('POST');

    $('#estado').attr({ 'disabled': true });
    $('#btnFormulario').attr({ 'disabled': true });
    $('#btnLimpiar').attr({ 'disabled': true });
    $('#codpatrimonio').attr({ 'disabled': false });
    $('#codpatrimonio').val('');
    $('#btnBuscar').attr({ 'disabled': false });

    $('#codutes').val('');
    $('#codinterno').val('');
    $('#codservicio').val('');
    $('#servicio').val('');
    $('#patrimonio').val('');
    $('#categoria').val('');
    $('#comentario').val('');
    $('#estado').val('');
}

function Eliminar(e) {
    let codutes = $(e).attr('data-codinterno');
    $.ajax({
        type: "delete",
        url: "/api/remover_bajapatrimonio/" + codutes,
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                if ($('.registro').hasClass('btn-primary')) { //Posiblemente sin uso
                    $('.registro').removeClass('btn-primary');
                    $('.registro').addClass('btn-warning');
                    $('.registro').text('Actualizar');
                }
                CargarDetalle();
                Limpiar();
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