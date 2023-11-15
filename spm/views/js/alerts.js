const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_fomulario_ajax(e) {
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezado = new Headers();

    let config = {
        method: method,
        headers: encabezado,
        node: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;

    if (tipo === "save") {
        texto_alerta = "Los datos ingresados se guardarán en el sistema";
    } else if (tipo === "delete") {
        texto_alerta = "Los datos seleccionados serán borrados del sistema";
    } else if (tipo === "update") {
        texto_alerta = "Los datos seleccionados serán actualizados y enviados al sistema";
    } else if (tipo === "search") {
        texto_alerta = "La búsqueda realizada será eliminada";
    } else if (tipo === "loans") {
        texto_alerta = "Se removerá la información seleccionada para préstamos o reservaciones?";
    } else {
        texto_alerta = "¿Quiere realizar la siguiente operación?";       
    }

    Swal.fire({
        title: '¿Está seguro?',
        text: texto_alerta,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            fetch(action, config)
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                return alertas_ajax(respuesta);
            });
        }
    });
}

formulario_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_fomulario_ajax)
});

function alertas_ajax(alerta) {
    if (alerta.Alerta === "simple") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.Alerta === "recargar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    } else if (alerta.Alerta === "limpiar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                document.querySelector(".FormularioAjax").reset();
            }
        });
    } else if (alerta.Alerta === "redireccionar") {
        window.location.href = alerta.URL;
    }
}
