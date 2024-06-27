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