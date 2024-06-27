$(document).ready(function() {
    $('input[data-table]').keyup(function(e) {
        let buscador = $(this).val().toUpperCase();
        let tablaID = $(this).data('table'); // Obtener el ID de la tabla desde el atributo data-table
        console.log('Buscador:', buscador);
        console.log('Tabla ID:', tablaID);

        if (buscador === '') {
            $(tablaID + ' .option-table').show();
        } else {
            $(tablaID + ' .option-table').hide();
            $(tablaID + ` .option-table[data-filter*="${buscador}"]`).show();
        }
    });
});