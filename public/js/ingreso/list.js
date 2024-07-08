$('#dt-search-0').addClass('pb-2');
datatable = new DataTable('#tablaIngreso', { //Configuración de DataTable de vista.
    'responsive': true,
    'lengthChange': false,
    'autoWidth': false,
    'scrollCollapse': true,
    'scroller': true,
    ajax: {                                  //Obtencion de datos
        url: "/api/informacion_ingresoreporte",
        type: "get",
        dataType: "json",
        dataSrc: "_ingreso",
    },
    columns: [{                             //Definicion de contenido de columnas
        data: 'NumeroInterno'
    },
    {
        data: 'NumeroPecosa'
    },
    {
        data: 'Fecha'
    },
    {
        data: null,                         //Botones de registro
        render: function (param) {
            return param['IdOrigen'] == 4 ? param['OtroOrigen'] : param['Origen'];
        }
    },
    {
        data: 'Personal'
    },
    {
        data: 'Observacion'
    },
    {
        data: null,                         //Botones de registro
        render: function (param) {
            return `<div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-info" type="button" data-numeropecosa="${param['NumeroPecosa']}" onClick="ver('${param['NumeroPecosa']}')">Ver</button>
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

function ver(id) {
    $.ajax({
        type: "get",
        url: `/api/informacion_ingresodetalle/${id}`,
        dataType: "json",
        success: function (response) {
            if (response._detalleingreso.length > 0) {
                //$('#detalleCodUtes').text(response._detalleingreso[0].CodUTES);
                let tabla = ''
                response._detalleingreso.forEach(element => {
                    tabla += `<tr>
                        <td>${element.CodUTES}</td><td>${element.CodInterno}</td><td>${element.Articulo}</td>
                        <td>${element.Servicio}</td><td>${element.Descripcion}</td><td>${element.Categoria}</td>
                        <td>${element.Estado}</td></tr>`
                        /*
                    tabla += (element.Operativo == 1) ?
                        `<td><p class="bg-success text-white p-2 d-inline rounded-pill">Si</p></td>` :
                        `<td><p class="bg-danger text-white p-2 d-inline rounded-pill">No</p></td>`
                    tabla += (element.Baja == 1) ?
                        `<td><p class="bg-warning text-white p-2 d-inline rounded-pill">Si</p></td>` :
                        `<td><p class="bg-success text-white p-2 d-inline rounded-pill">No</p></td>`*/
                });
                $('#tablaDetalle').html(tabla);
                ModalAbrirCerrar('verDetalle', true);
            } else {
                alert('No se pudo obtener el detalle.');
            }
        },
        error: function () {
            alert('Error al obtener el detalle.');
        }
    });
}