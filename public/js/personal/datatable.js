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
            return param['Estado'] = 1 ?
                `<p class="bg-success text-white p-2 d-inline rounded-pill">Activo</p>` :
                `<p class="bg-danger text-white p-2 d-inline rounded-pill">Inactivo</p>`
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
                                <li><a style="cursor: pointer;" class="dropdown-item" href="#">Retirar</a></li>
                            </ul>
                        </div>`
        }
    }
    ],
    dom: 'Bfrtip',
    buttons: ['excel', 'pdf'],
    pageLength: 10,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
    }
});