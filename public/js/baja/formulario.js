function IniciarTramite() {
    let codoficio = document.getElementById('codoficio').value;
    if (codoficio != "") {
        $.ajax({
            type: "get",
            url: `/api/informacion_baja/${codoficio}`,
            dataType: "json",
            success: function (response) {
                //Validación de campo
                if (response._baja != null) {
                    $('#observacion').text(response._baja.Observacion);
                    CargarDetalle();
                    $('#observacion').attr({ 'disabled': true })

                } else {
                    alert('Se esta registrando un nuevo oficio de baja.');
                    $('#observacion').attr({ 'disabled': false })
                }
                $('#btnTramitar').attr({ 'disabled': true })
                $('#codoficio').attr({ 'disabled': true })

                $('#codpatrimonio').attr({ 'disabled': false })
                $('#btnBuscar').attr({ 'disabled': false })
            },
            error: function () {
                alert('Error al obtener información.');
            }
        });
    }
}

function CargarDetalle() {
    let codoficio = document.getElementById('codoficio').value;
    $('#dt-search-0').addClass('pb-2');
    if (!$.fn.DataTable.isDataTable('#tablaBaja')) {
        datatable = new DataTable('#tablaBaja', {
            'responsive': true,
            'lengthChange': false,
            'autoWidth': false,
            'scrollCollapse': true,
            'scroller': true,
            ajax: {
                url: '/api/informacion_bajadetalle/' + codoficio,
                type: 'get',
                dataType: 'json',
                dataSrc: "_detallebaja"
            },
            columns: [{
                data: 'CodUTES'
            },
            {
                data: 'CodInterno'
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
                                <button class="btn btn-warning" type="button" data-codutes="${param['CodUTES']}" onClick="Eliminar(this)">Eliminar</button>
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
                $('#codutes').val(response._detallepatrimonio['CodUTES']);
                $('#codinterno').val(response._detallepatrimonio['CodInterno']);
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
                let errors = xhr.response.errors;
                errorMsg = '';
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errorMsg += `${errors[field][0]} `;
                        console.log(errorMsg);
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
}

function GuardarBaja() {
    // Informacion PECOSA
    let codoficio = document.getElementById('codoficio').value;
    let observacion = document.getElementById('observacion').value;
    let idpersonal = 1;

    //Informacion Patrimonio
    let codutes = document.getElementById('codutes').value;
    let estado = document.getElementById('estado').value;
    var baja = {
        "CodigoBaja": codoficio,
        "Observacion": observacion,
        "IdPersonal": idpersonal,

        "CodUTES": codutes,

        "Estado": estado
    };
    //Ubicacion

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
                let errors = xhr.response.errors;
                errorMsg = '';
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errorMsg += `${errors[field][0]} `;
                        console.log(errorMsg);
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
    $('#servicio').val('');
    $('#patrimonio').val('');
    $('#categoria').val('');
    $('#comentario').val('');
    $('#estado').val('');
}

function Eliminar(e) {
    let codutes = $(e).attr('data-codutes');
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
        }, error: function (error) {
            console.log(error);
        }, before: function () {
            LoadingOverlay(true);
        }
    });
}