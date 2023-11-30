<script>
    let btn_cerrar_sesion = document.querySelector(".btn-exit-system");

    btn_cerrar_sesion.addEventListener('click', function(e){
		e.preventDefault();
		Swal.fire({
			title: '¿Está seguro de cerrar la sesión?',
			text: "Está a punto de cerrar la sesión y salir del sistema",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $lc->encryption($_SESSION['token_spm']); ?>';
				let usuario = '<?php echo $lc->encryption($_SESSION['usuario_spm']); ?>'; 
				
				let datos = new FormData();
				datos.append("token", token);
				datos.append("usuario", usuario);

				fetch(url, {
					method: "POST",
					body: datos
				})
				.then(respuesta => respuesta.json())
				.then(respuesta => {
					return alertas_ajax(respuesta);
				});
			}
		});
	});
</script>