function listarDatos() {
    $.ajax({
        type: "get",
        url: "/api/informacion_origenserviciocategoria",
        data: false,
        dataType: "json",
        contentType: "application/json",
        processData: false,
        success: function (response) {
            if (response.exito) {
                let origen = `<option value="">.: Seleccionar :.</option>`
                if (response._origen.length > 0) {
                    response._origen.forEach(element => {
                        origen += `<option value=${element.IdOrigen}>${element.Descripcion}</option>`
                    });
                }
                $('#origen').html(origen);

                let categoria = `<option value="">.: Seleccionar :.</option>`
                if (response._categoria.length > 0) {
                    response._categoria.forEach(element => {
                        categoria += `<option value=${element.IdCategoria}>${element.Descripcion}</option>`
                    });
                }
                $('#categoria').html(categoria);

                let servicio = `<option value="">.: Seleccionar :.</option>`
                if (response._servicio.length > 0) {
                    response._servicio.forEach(element => {
                        servicio += `<option value=${element.IdServicio}>${element.Descripcion}</option>`
                    });
                }
                $('#servicio').html(servicio);
                $('#ubicacion').html(servicio);
            }
        },
        error: function (xhr) {
            LoadingOverlay(false);
            let errorMsg = 'Error en la validación.';
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                errorMsg = '';
                for (let field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        errorMsg += `+ ${errors[field][0]} <br/>`;
                    }
                }
            } else if (xhr.response?.mensajeError) {
                errorMsg = xhr.response.mensajeError;
            }
            Alertas('Error', errorMsg, 'error');
        }
    });
}
listarDatos();