$(document).ready(function () {
    $('#rangoFecha').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month')
    });

    let tablaLista = new DataTable('#tablaIngreso', {
        'responsive': true,
        'lengthChange': false,
        'autoWidth': false,
        'scrollCollapse': true,
        'scroller': true,
        ajax: {
            url: "/api/informacion_ingresoreporte",
            type: "get",
            dataType: "json",
            dataSrc: "_ingreso",
        },
        columns: [
            { data: 'NumeroInterno' },
            { data: 'NumeroPecosa' },
            { data: 'Fecha' },
            {
                data: null,
                render: function (param) {
                    return param['IdOrigen'] == 4 ? param['OtroOrigen'] : param['Origen'];
                }
            },
            { data: 'Personal' },
            { data: 'Observacion' },
            {
                data: null,
                render: function (param) {
                    return `<div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-info" type="button" data-numerointerno="${param['NumeroInterno']}" onclick="Ver(this)">Ver</button>
                            </div>`
                }
            }
        ],
        dom: 'Brtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Reporte de Ingresos',
                customize: function (xlsx) {
                    excelEditado(xlsx);
                }
            },
            {
                extend: 'pdf',
                filename: 'reporte_ingresos',
                text: 'PDF',
                title: 'Reporte de Ingresos',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // o ':visible'
                },
                customize: function (doc) {
                    pdfReporteIngreso(doc, false);
                }
            }
        ],
        pageLength: 5,
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
        tablaLista.ajax.url('/api/informacion_ingresoreporte?fechaInicio=' + fechaInicio + '&fechaFin=' + fechaFin).load();
    });

    // Configurar el buscador
    $('#buscar').on('keyup', function () {
        tablaLista.search(this.value).draw();
    });

    /*$(document).ready(function () {
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
    });*/
});

var datatable;
function Ver(e) {
    let numerointerno = $(e).attr('data-numerointerno');
    $.ajax({
        url: `/api/informacion_ingresodetalle/${numerointerno}`,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response.exito) {
                localStorage.setItem('ingreso', JSON.stringify(response._ingreso));
                ModalAbrirCerrar('verDetalle', true);
                $('#dt-search-0').addClass('pb-2');
                if (!$.fn.DataTable.isDataTable('#tablaDetalle')) {
                    datatable = new DataTable('#tablaDetalle', {
                        'responsive': true,
                        'lengthChange': false,
                        'autoWidth': false,
                        'scrollCollapse': true,
                        'scroller': true,
                        ajax: {
                            url: `/api/informacion_ingresodetalle/${numerointerno}`,
                            type: 'get',
                            dataType: 'json',
                            dataSrc: "_detalleingreso"
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
                                filename: 'reporte_detalle_ingreso',
                                text: 'PDF',
                                title: 'Detalle de Ingreso',
                                exportOptions: {
                                    columns: ':visible'
                                },
                                customize: function (doc) {
                                    pdfReporteIngreso(doc, true);
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
                    datatable.ajax.url(`/api/informacion_ingresodetalle/${numerointerno}`).load();
                }
            } else {
                Alertas('Error', response.mensaje, 'error');
            }
        },
        error: function (xhr, status, error) {
            Alertas('Error', error, 'error');
        }
    });
}
