/*Todo lo llena el metodo - Proceso: JS llama a API, API llama a Controller, Controller devuelve a API y luego a JS, JS arma HTML e inyecta a Tabla(ID)*/
$('#dt-search-0').addClass('pb-2');
datatable = new DataTable('#tablaPersonal', {
    'responsive': true,
    'lengthChange': false,
    'autoWidth': false,
    'scrollCollapse': true,
    'scroller': true,
    ajax: {
        url: '/api/informacion_personal',
        type: 'get',
        dataType: 'json',
        dataSrc: "_personal"
    },
    columns: [{
        data: 'Dni'
    },
    {
        data: 'Persona'
    },
    {
        data: 'Celular'
    },
    {
        data: 'Condicion'
    },
    {
        data: 'Servicio'
    },
    {
        data: null,
        render: function (param) {
            return `<a>IMPLEMENTAR</a>`
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
                                <li><a style="cursor: pointer;" class="dropdown-item" data-dni="${param['Dni']}" onclick="Ver(this)">Ver</a></li>    
                                <li><a style="cursor: pointer;" class="dropdown-item" data-dni="${param['Dni']}" onclick="Editar(this)">Editar</a></li>
                                <li><a style="cursor: pointer;" class="dropdown-item" data-dni="${param['Dni']}" onclick="Eliminar(this)">Eliminar</a></li>
                            </ul>
                        </div>`
        }
    }
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