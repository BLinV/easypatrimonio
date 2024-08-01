document.addEventListener('DOMContentLoaded', function () {
    $(`#tipo`).autocomplete({
        source: function (request, response) { // Request rescata el input del usuario, Response procesa lo que llega de BD
            $.ajax({
                url: "/api/informacion_tipoBuscar",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data)
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
    });

    $(`#marca`).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/informacion_marcaBuscar",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data)
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
    });

    $(`#categoria`).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/api/informacion_categoriaBuscar",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data)
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
    });

    const txtTipo = document.querySelector('#tipo');
    const txtMarca = document.querySelector('#marca');
    const txtModelo = document.querySelector('#modelo');
    const txtPatrimonio = document.querySelector('#patrimonio');
    if (txtTipo && txtMarca && txtModelo && txtPatrimonio) {
        txtTipo.addEventListener('change', () => {
            txtPatrimonio.value = txtTipo.value + ' ' + txtMarca.value + ' ' + txtModelo.value;
        });
        txtMarca.addEventListener('change', () => {
            txtPatrimonio.value = txtTipo.value + ' ' + txtMarca.value + ' ' + txtModelo.value;
        });
        txtModelo.addEventListener('change', () => {
            txtPatrimonio.value = txtTipo.value + ' ' + txtMarca.value + ' ' + txtModelo.value;
        });
    } else {
        console.error('Uno o más elementos no se encontraron en el DOM.');
    }
});