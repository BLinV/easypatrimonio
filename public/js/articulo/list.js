$('#dt-search-0').addClass('pb-2');
datatable = new DataTable('#tablaPatrimonio', { //Configuración de DataTable de vista.
    'responsive': true,
    'lengthChange': false,
    'autoWidth': false,
    'scrollCollapse': true,
    'scroller': true,
    ajax: {                                  //Obtencion de datos
        url: "/api/informacion_patrimonioreporte",
        type: "get",
        dataType: "json",
        dataSrc: "_patrimonio",
    },
    columns: [
        {                             //Definicion de contenido de columnas
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
            data: 'Categoria'
        },
        {
            data: null,                         //Botnoes de registro
            render: function (param) {
                return (param['Operativo']) ?
                    `<p class="bg-success text-white p-2 d-inline rounded-pill">Si</p>` :
                    `<p class="bg-danger text-white p-2 d-inline rounded-pill">No</p>`
            }
        },
        {
            data: null,                         //Botnoes de registro
            render: function (param) {
                return param['Baja'] ?
                    `<p class="bg-warning text-white p-2 d-inline rounded-pill">Si</p>` :
                    `<p class="bg-success text-white p-2 d-inline rounded-pill">No</p>`
            }
        },
        {
            data: null,
            render: function (param) {
                return `<div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-codinterno="${param['CodInterno']}" onclick="Ver(this)">Ver</a></li>    
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-codinterno="${param['CodInterno']}" onclick="Actualizar(this)">Actualizar</a></li>
                                </ul>
                            </div>`
            }
        }
    ],
    dom: 'Bfrtip',               //Definicion de estructura de tabla, botones (B), un filtro (f), información (i), paginación (p), y el contenido de la tabla (t).
    buttons: ['excel', 'pdf'],   //Exportar en excel y pdf
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

document.addEventListener('DOMContentLoaded', function () {
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

$(document).ready(function () {
    $('input[data-table]').keyup(function (e) {
        let buscador = $(this).val().toUpperCase();
        let tablaID = $(this).data('table'); // Obtener el ID de la tabla desde el atributo data-table
        if (buscador === '') {
            $(tablaID + ' .option-table').show();
        } else {
            $(tablaID + ' .option-table').hide();
            $(tablaID + ` .option-table[data-filter*="${buscador}"]`).show();
        }
    });
});

var tablaMovimientos;
function cargarDetalle(codinterno) {
    $('#dt-search-0').addClass('pb-2');
    if (!$.fn.DataTable.isDataTable('#tablaDetalle')) {
        tablaMovimientos = $('#tablaDetalle').DataTable({
            'responsive': true,
            'lengthChange': false,
            'autoWidth': false,
            'scrollCollapse': true,
            'scroller': true,
            ajax: {
                url: `/api/informacion_movimientopatrimonio/${codinterno}`,
                type: "get",
                dataType: "json",
                dataSrc: "_ubicacion",
            },
            columns: [
                { data: 'Fecha' },
                { data: 'Servicio' },
                { data: 'Persona' },
                { data: 'Motivo' }
            ],
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
    }
}

function Ver(e) {
    let codinterno = $(e).attr('data-codinterno');
    ModalAbrirCerrar('verDetalle', true);
    $.ajax({
        type: "get",
        url: `/api/informacion_detallepatrimonioreporte/${codinterno}`,
        dataType: "json",
        success: function (response) {
            $('#codInterno').text(codinterno);
            if (response._origen != null) {
                $('#ingresoDocumento').text(response._origen.NumeroInterno);
                $('#ingresoIngreso').text(response._origen.NumeroPecosa);
                $('#ingresoFecha').text(response._origen.Fecha);
                $('#ingresoEstado').text(response._origen.Estado);
                $('#ingresoOrigen').text(response._origen.Origen);
            } else {
                $('#ingresoDocumento').text(" No encontrado. ");
                $('#ingresoIngreso').text(" No encontrado. ");
                $('#ingresoFecha').text(" No encontrado. ");
                $('#ingresoEstado').text(" No encontrado. ");
                $('#ingresoOrigen').text(" No encontrado. ");
            }
            if (response._baja != null) {
                $('#bajaDocumento').text(response._baja.CodigoBaja);
                $('#bajaFecha').text(response._baja.Fecha);
                $('#bajaEstado').text(response._baja.Estado);
            } else {
                $('#bajaDocumento').text(" No encontrado. ");
                $('#bajaFecha').text(" No encontrado. ");
                $('#bajaEstado').text(" No encontrado. ");
            }
            if (response._servicio != null) {
                $('#servicioPertenencia').text(response._servicio);
            } else {
                $('#servicioPertenencia').text(" No encontrado. ");
            }
            if (response._ubicacion != null) {
                $('#ubicacionActual').text(response._ubicacion);
            } else {
                $('#ubicacionActual').text(" No encontrado. ");
            }
            cargarDetalle(codinterno);
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

function GuardarMovimiento() {
    // Informacion PECOSA
    let codigo = document.getElementById('codInterno').innerText;
    let servicio = document.getElementById('servicio').value;
    let personal = document.getElementById('personal').value;
    let motivo = document.getElementById('motivo').value;

    let movimiento = {
        "CodInterno": codigo,
        "IdServicio": servicio,
        "IdPersonal": personal,
        "Motivo": motivo,
    };

    $.ajax({
        type: "post",
        url: "/api/registrar_movimiento",
        data: JSON.stringify(movimiento),
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            LoadingOverlay(false);
            if (response.exito) {
                Alertas('Confirmación', response.mensaje, 'success');
                Limpiar();
                tablaMovimientos.ajax.reload();
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
        },
        beforeSend: function () {
            LoadingOverlay(true);
        }
    });
}

function Limpiar() {
    $('#servicio').val("");
    $('#personal').val("");
    $('#personal').html(`<option value="">.: Seleccionar :.</option>`);
    $('#personal').attr({ 'disabled': true })
    $('#motivo').val("");
}

function Actualizar(e) {
    let codinterno = $(e).attr('data-codinterno');
    ModalAbrirCerrar('actualizar', true);
    $.ajax({
        type: "get",
        url: `/api/informacion_detallepatrimonioreporte/${codinterno}`,
        dataType: "json",
        success: function (response) {
            $('#codInterno').text(codinterno);
            if (response._origen != null) {
                $('#ingresoDocumento').text(response._origen.NumeroInterno);
                $('#ingresoIngreso').text(response._origen.NumeroPecosa);
                $('#ingresoFecha').text(response._origen.Fecha);
                $('#ingresoEstado').text(response._origen.Estado);
                $('#ingresoOrigen').text(response._origen.Origen);
            } else {
                $('#ingresoDocumento').text(" No encontrado. ");
                $('#ingresoIngreso').text(" No encontrado. ");
                $('#ingresoFecha').text(" No encontrado. ");
                $('#ingresoEstado').text(" No encontrado. ");
                $('#ingresoOrigen').text(" No encontrado. ");
            }
            if (response._baja != null) {
                $('#bajaDocumento').text(response._baja.CodigoBaja);
                $('#bajaFecha').text(response._baja.Fecha);
                $('#bajaEstado').text(response._baja.Estado);
            } else {
                $('#bajaDocumento').text(" No encontrado. ");
                $('#bajaFecha').text(" No encontrado. ");
                $('#bajaEstado').text(" No encontrado. ");
            }
            if (response._servicio != null) {
                $('#servicioPertenencia').text(response._servicio);
            } else {
                $('#servicioPertenencia').text(" No encontrado. ");
            }
            if (response._ubicacion != null) {
                $('#ubicacionActual').text(response._ubicacion);
            } else {
                $('#ubicacionActual').text(" No encontrado. ");
            }
            cargarDetalle(codinterno);
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
