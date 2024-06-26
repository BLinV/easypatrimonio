const Alertas = (titulo, texto, icono) => {
    Swal.fire({
        title: titulo,
        html: texto,
        icon: icono
    });
}

const ValidarTexto = (input) => {
    let campo = $(input).val()
    let regex = /^[a-zA-Z]+$/;
    if (!regex.test(campo)) {
        $(input).val($(input).val().substring(0, $(input).val().length - 1));
    }
}

const ValidarNumeros = (input) => {
    let campo = $(input).val()
    let regex = /[^0-9]/g;
    if (regex.test(campo)) {
        $(input).val($(input).val().substring(0, $(input).val().length - 1));
    }

    let name = $(input).attr('name')
    if (name == 'dni') {
        if (campo.length > 8) {
            $(input).val($(input).val().substring(0, $(input).val().length - 1));
        }
    }

    if (name == 'celular') {
        if (campo.length > 9) {
            $(input).val($(input).val().substring(0, $(input).val().length - 1));
        }
    }
}

const LoadingOverlay = (validar) => {
    if (validar) {
        $.LoadingOverlay("show", {
            imageResizeFactor: 2,
            text: 'Cargando ......',
            size: 14
        });
    } else {
        $.LoadingOverlay("hide");
    }
}

function ModalAbrirCerrar(name, boolean){
    let modal = new bootstrap.Modal(document.getElementById(name), {
    keyboard: false
    })
    if (boolean) {
        modal.show()
    } else {
        modal.hide()
    }
}