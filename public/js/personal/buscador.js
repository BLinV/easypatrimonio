$('#buscador').keyup(function (e) {
    var buscador = $(this).val()
    console.log(buscador);
    if (buscador == '') {
        $("#tablaPersonal .option-table").show();
    } else {
        $("#tablaPersonal .option-table").hide();
        $("#tablaPersonal .option-table[data-filter\*='" + buscador.toUpperCase() + "']").show();
    }

});