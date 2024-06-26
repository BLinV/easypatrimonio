function listarDatos() {
    $.ajax({
        type: "get",
        url: "/api/informacion_ingresoreporte",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            console.log(response);
            if(response.exito){
                let tabla = ''
                if(response._ingreso.length > 0){
                    response._ingreso.forEach(element => {
                        tabla += `<tr>
                        <td>${element.NumeroPecosa}</td><td>${element.Fecha}</td><td>${element.Origen}</td>
                        <td>${element.Observacion}</td><td>${element.Personal}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-info" type="button" action="javascrip:void(0)">Ver</button>
                            </div>
                        </td></tr>`
                    });
            } else {
                tabla += `<tr><td colspan="9">No se encontraron registros.</td></tr>`
            }
            $('#tablaIngreso').html(tabla);
            }
        }
    });
}
listarDatos();