function listarDatos() {
    $.ajax({
        type: "get",
        url: "/api/informacion_bajareporte",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            console.log(response);
            if(response.exito){
                let tabla = ''
                if(response._baja.length > 0){
                    response._baja.forEach(element => {
                        tabla += `<tr class="option-table" data-filter="${element.CodigoBaja} ${element.Personal.toUpperCase()}">
                        <td>${element.CodigoBaja}</td><td>${element.Fecha}</td>
                        <td>${element.Observacion}</td><td>${element.Personal}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-info" type="button" action="javascrip:void(0)">Ver</button>
                            </div>
                        </td></tr>`
                    });
            } else {
                tabla += `<tr><td colspan="5">No se encontraron registros.</td></tr>`
            }
            $('#tablaBaja').html(tabla);
            }
        }
    });
}
listarDatos();