<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
    <?php include "./views/inc/Links.php"; ?>

</head>
<body>
	<?php
		$peticionesAjax = false;
		require_once "./controllers/viewsController.php";
		$IV = new viewsController();

		$vistas = $IV->obtener_vistas_coontrolador();

		if ($vistas == "login" || $vistas == "404") {
			require_once "./views/contents/".$vistas."-view.php";
		} else {
		?>
			<!-- Main container -->
			<main class="full-box main-container">
			<!-- Nav lateral -->
			<?php include "./views/inc/NavLateral.php"; ?>

			<!-- Page content -->
			<section class="full-box page-content">
				<?php 
					include "./views/inc/NavBar.php"; 

					include $vistas;
				?>
			</section>
		</main>
		<?php 
			}
			include "./views/inc/Scripts.php"; 
		?>
</body>
</html>