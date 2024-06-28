document.addEventListener('DOMContentLoaded', function() {
    const origenSelect = document.getElementById('origen');
    const otroOrigenContainer = document.getElementById('otroorigen-container');

    origenSelect.addEventListener('change', function() {
        if (origenSelect.value === '4') {
            otroOrigenContainer.style.display = 'block';
        } else {
            otroOrigenContainer.style.display = 'none';
        }
    });
});

// Arreglo para almacenar los patrimonios a registrar
let patrimonios = [];

// Función para agregar una fila a la tabla de patrimonios
function agregarFilaPatrimonio(patrimonio) {
    let fila = `<tr>
        <td>${patrimonio.CodUTES}</td>
        <td>${patrimonio.CodInterno}</td>
        <td>${patrimonio.Articulo}</td>
        <td>${patrimonio.Comentario}</td>
        <td>${patrimonio.Categoria}</td>
        <td>${patrimonio.Servicio}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button"
                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                    Acciones
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                    <li><a class="dropdown-item" href="#">Modificar</a></li>
                    <li><a class="dropdown-item" href="#">Eliminar</a></li>
                </ul>
            </div>
        </td>
    </tr>`;
    $('#tablaPatrimonio tbody').append(fila);
}

// Evento al hacer clic en el botón Validar
$('#btnValidar').click(function() {
    // Aquí puedes validar y agregar el patrimonio al arreglo patrimonios
    let nuevoPatrimonio = {
        CodUTES: '1234asdasd9ABC', // Ejemplo de valores, debes obtener estos valores del formulario
        CodInterno: '123456789ABC',
        Articulo: 'Monitor HP 1800px',
        Comentario: 'Operativo',
        Categoria: 'Vigilancia',
        Servicio: 'Vigilancia'
    };
    patrimonios.push(nuevoPatrimonio);

    // Llamar función para agregar fila a la tabla
    agregarFilaPatrimonio(nuevoPatrimonio);

    // Limpiar campos del formulario después de añadir el patrimonio
    // Ejemplo: $('#campoCodigo').val('');
});

// Evento al hacer clic en el botón Registrar
$('#btnRegistrar').click(function() {
    // Convertir arreglo de patrimonios a JSON
    let patrimoniosJSON = JSON.stringify(patrimonios);

    // Aquí puedes enviar patrimoniosJSON por medio de una petición AJAX al controlador
    console.log('Enviando patrimonios JSON al servidor...');
    console.log(patrimoniosJSON);

    // Ejemplo de petición AJAX para enviar datos al controlador (debes adaptar esto a tu backend)
    /*
    $.ajax({
        url: '/guardar-patrimonios',
        type: 'POST',
        contentType: 'application/json',
        data: patrimoniosJSON,
        success: function(response) {
            console.log('Datos guardados correctamente');
            // Puedes agregar lógica adicional después de guardar los datos
        },
        error: function(error) {
            console.error('Error al guardar los datos');
        }
    });
    */
});