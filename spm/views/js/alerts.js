const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_fomulario_ajax() {
    e.preventDefault();
}

formulario_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_fomulario_ajax)
});

function alertas_ajax(alerta) {
    
}
