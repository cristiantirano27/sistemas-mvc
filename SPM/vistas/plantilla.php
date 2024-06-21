<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
    <?php require_once "./vistas/inc/Link.php"; ?>
</head>
<body>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
		<?php require_once "./vistas/inc/NavLateral.php"; ?>

		<!-- Page content -->
		<section class="full-box page-content">
	        <?php require_once "./vistas/inc/NavBar.php"; ?>
    	</section>
	</main>
	<?php require_once "./vistas/inc/Scripts.php"; ?>	
</body>
</html>