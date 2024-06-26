const Alertas = (titulo, texto, icono) => {
    swal({
        title: titulo,
        text: texto,
        icon: icono
    });
}

const ValidarTexto = (input) => {
    var campo = $(input).val()
    var regex = /^[a-zA-Z]+$/;
    if (!regex.test(campo)) {
        $(input).val($(input).val().substring(0, $(input).val().length - 1));
    }
}

const ValidarNumeros = (input) => {
    var campo = $(input).val()
    var regex = /[^0-9]/g;
    if (regex.test(campo)) {
        $(input).val($(input).val().substring(0, $(input).val().length - 1));
    }

    var name = $(input).attr('name')
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
    var modal = new bootstrap.Modal(document.getElementById(name), {
    keyboard: false
    })
    if (boolean) {
        modal.show()
    } else {
        modal.hide()
    }
}