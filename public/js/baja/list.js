$(document).ready(function () {
    $('#rangoFecha').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month')
    });

    let tablaLista = new DataTable('#tablaBaja', { //Configuración de DataTable de vista.
        'responsive': true,
        'lengthChange': false,
        'autoWidth': false,
        'scrollCollapse': true,
        'scroller': true,
        ajax: {                                  //Obtencion de datos
            url: "/api/informacion_bajareporte",
            type: "get",
            dataType: "json",
            dataSrc: "_baja",
        },
        columns: [
            { data: 'CodigoBaja' },
            { data: 'Fecha' },
            { data: 'Observacion' },
            { data: 'Personal' },
            {
                data: null,                         //Botnoes de registro
                render: function (param) {
                    return `<div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-info" type="button" data-codigobaja="${param['CodigoBaja']}" onclick="Ver(this)">Ver</button>
                            </div>`
                }
            }
        ],
        dom: 'Brtip',               // Bfrtip Definicion de estructura de tabla, botones (B), un filtro (f), información (i), paginación (p), y el contenido de la tabla (t).
        buttons: [
            {
                extend: 'excel',
                title: 'Reporte de Bajas',
                customize: function (xlsx) {
                    excelEditado(xlsx);
                }
            },
            {
                extend: 'pdf',
                filename: 'reporte_bajas',
                text: 'PDF',
                title: 'Reporte de Bajas',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                },
                customize: function (doc) {
                    pdfReporteBaja(doc, false);
                }
            }
        ],   //Exportar en excel y pdf
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

    $('#btnFiltrar').click(function () {
        let dateRange = $('#rangoFecha').val().split(' - ');
        let fechaInicio = dateRange[0];
        let fechaFin = dateRange[1];
        tablaLista.ajax.url('/api/informacion_bajareporte?fechaInicio=' + fechaInicio + '&fechaFin=' + fechaFin).load();
    });

    // Configurar el buscador
    $('#buscar').on('keyup', function () {
        tablaLista.search(this.value).draw();
    });
    /*
    $('input[data-table]').keyup(function (e) {
        let buscador = $(this).val().toUpperCase();
        let tablaID = $(this).data('table'); // Obtener el ID de la tabla desde el atributo data-table
        if (buscador === '') {
            $(tablaID + ' .option-table').show();
        } else {
            $(tablaID + ' .option-table').hide();
            $(tablaID + ` .option-table[data-filter*="${buscador}"]`).show();
        }
    });*/
});

var tablaDetalle;
function Ver(e) {
    let codigobaja = $(e).attr('data-codigobaja');
    $.ajax({
        url: `/api/informacion_bajadetalle/${codigobaja}`,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response.exito) {
                localStorage.setItem('baja', JSON.stringify(response._baja));
                ModalAbrirCerrar('verDetalle', true);
                $('#dt-search-0').addClass('pb-2');
                if (!$.fn.DataTable.isDataTable('#tablaDetalle')) {
                    tablaDetalle = new DataTable('#tablaDetalle', {
                        'responsive': true,
                        'lengthChange': false,
                        'autoWidth': false,
                        'scrollCollapse': true,
                        'scroller': true,
                        ajax: {
                            url: `/api/informacion_bajadetalle/${codigobaja}`,
                            type: 'get',
                            dataType: 'json',
                            dataSrc: "_detallebaja"
                        },
                        columns: [
                            { data: 'CodInterno' },
                            { data: 'CodUTES' },
                            { data: 'CodServicio' },
                            { data: 'Articulo' },
                            { data: 'Servicio' },
                            { data: 'Categoria' },
                            { data: 'Descripcion' },
                            { data: 'Estado' }
                        ],
                        dom: 'Bfrtip',
                        buttons: ['excel',
                            {
                                extend: 'pdf',
                                filename: 'reporte_detalle_baja',
                                text: 'PDF',
                                title: 'Detalle de Baja',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                customize: function (doc) {
                                    pdfReporteBaja(doc, true);
                                }
                            }
                        ],
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
                    tablaDetalle.ajax.url(`/api/informacion_bajadetalle/${codigobaja}`).load();
                }
            } else {
                Alertas('Error', response.mensaje, 'error');
            }
        },
        error: function (xhr, status, error) {
            Alertas('Error', error, 'error');
            console.log(error)
        }
    });
}