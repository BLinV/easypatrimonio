document.addEventListener('DOMContentLoaded', function () {
    const origenSelect = document.getElementById('origen');
    const otroOrigenContainer = document.getElementById('otroorigen-container');

    origenSelect.addEventListener('change', function () {
        if (origenSelect.value === '4') {
            otroOrigenContainer.style.display = 'block';
        } else {
            otroOrigenContainer.style.display = 'none';
        }
    });
});

let listapatrimonios = []

function obtenerTextoOption(selectId, value) {
    const select = document.getElementById(selectId);
    const options = select.options;
    for (let i = 0; i < options.length; i++) {
        if (options[i].value === value) {
            return options[i].text;
        }
    }
    return null;
}

function agregarPatrimonio() {
    let codutes = document.getElementById('codutes').value;
    let codinterno = document.getElementById('codinterno').value;
    let tipo = document.getElementById('tipo').value;
    let marca = document.getElementById('marca').value;
    let modelo = document.getElementById('modelo').value;
    let categoria_id = document.getElementById('categoria').value;
    let servicio_id = document.getElementById('servicio').value;
    let comentario = document.getElementById('comentario').value;
    let operativo = 1;

    const servicio = obtenerTextoOption('servicio', servicio_id);
    const categoria = obtenerTextoOption('categoria', categoria_id);
    
                let ubicacion = document.getElementById('servicio').value;
    let detallePatrimonio = {
        "CodUTES": codutes,
        "CodInterno": codinterno,
        "tipo_descripcion": tipo,
        "marca_descripcion": marca,
        "modelo": modelo,
        "Descripcion": comentario,
        "IdCategoria": categoria_id,
        "IdServicio": servicio_id,
        "Operativo": operativo
    };

    listapatrimonios.push(detallePatrimonio);
    mostrarPatrimonios();
    limpiarPatrimonio();
        $.ajax({
            type: "get",
            url: "/api/verificar_patrimonio",
            data: JSON.stringify(detallePatrimonio),
            dataType: "json",
            contentType: "application/json",
            processData: false,
            success: function(response) {
                LoadingOverlay(false)

                if (response.exito) {
                    Alertas('Confirmación', response.mensaje, 'success')
                    mostrarPatrimonios();
                    limpiarPatrimonio();

                } else {
                    Alertas('Error', response.mensajeError, 'error')
                }
            },
            error: function(xhr) {
                LoadingOverlay(false);
                let errorMsg = 'Error en la validación.';
                console.log('xhr.response')
                console.log(xhr.response)
                if (xhr.status === 422) {
                    let errors = xhr.response.errors;
                    errorMsg = '';
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            errorMsg += `${errors[field][0]} `;
                            console.log(errorMsg);
                        }
                    }
                } else if (xhr.response?.mensajeError) {
                    errorMsg = xhr.response.mensajeError;
                }
                
                Alertas('Error', errorMsg, 'error');
            },
            beforeSend: function () {
                LoadingOverlay(true)
            }
        });
}

function mostrarPatrimonios() {
    const tbody = document.querySelector('#tablaIngreso tbody');
    tbody.innerHTML = '';
    if (listapatrimonios.length > 0) {
        listapatrimonios.forEach((detallePatrimonio, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${detallePatrimonio.CodUTES}</td>
            <td>${detallePatrimonio.CodInterno}</td>
            <td>${detallePatrimonio.tipo_descripcion} ${detallePatrimonio.marca_descripcion} ${detallePatrimonio.modelo}</td>
            <td>${detallePatrimonio.Descripcion}</td>
            <td>${detallePatrimonio.IdCategoria}</td>
            <td>${detallePatrimonio.IdServicio}</td>
            <td>
                <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button"
                    id="dropdown_acciones" data-bs-toggle="dropdown" aria-expanded="false">
                    Acciones
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown_acciones">
                        <li><a class="dropdown-item" onclick="modificarPatrimonio(${index})">Modificar</a></li>
                        <li><a class="dropdown-item" onclick="eliminarPatrimonio(${index})">Eliminar</a></li>
                    </ul>
                </div>
            </td>`;
            tbody.appendChild(tr);
        });
    }
    //   <button type="button" class="btn btn-danger" onclick="eliminarPatrimonio(${index})">Eliminar</button>
}


function limpiarPatrimonio() {
    //$('#dni').attr({ 'disabled': false })
    $('#codutes').val('')
    $('#codinterno').val('')
    $('#tipo').val('')
    $('#marca').val('')
    $('#modelo').val('')
    $('#patrimonio').val('')
    $('#comentario').val('')
    $('#categoria').val('')
    $('#servicio').val('')
}

function eliminarPatrimonio(index) {
    listapatrimonios.splice(index, 1);
    mostrarPatrimonios();
}

function modificarPatrimonio(index) {
    $('#codutes').val(listapatrimonios[index].codutes)
    $('#codinterno').val(listapatrimonios[index].codinterno)
    $('#tipo').val(listapatrimonios[index].tipo)
    $('#marca').val(listapatrimonios[index].marca)
    $('#modelo').val(listapatrimonios[index].modelo)
    $('#patrimonio').val(listapatrimonios[index].tipo + " "+ listapatrimonios[index].marca + " " + listapatrimonios[index].modelo)
    $('#comentario').val(listapatrimonios[index].comentario)
    $('#categoria').val(listapatrimonios[index].categoria_id)
    $('#servicio').val(listapatrimonios[index].servicio_id)
    listapatrimonios.splice(index, 1);
    mostrarPatrimonios();
}