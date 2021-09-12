<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<!-- Fuentes -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">

	<!-- Hoja de Estilos -->
	<link rel="stylesheet" href="../../resources/css/iniciar_sesion_privado.css">
	<title>Polus - Iniciar Sesión</title>
</head>

<body>
	<!-- Fondo -->
	<div id="background">
		<!-- Caja -->
		<div id="form" class="paddingLados animate__animated animate__fadeInUp animate__faster">
			<div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
				<!-- Columna 1 -->
				<div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 paddingLados">
					<h1 class="titulo mb-2 mt-3 pt-5">Iniciar Sesión</h1>
					<form method='post' id='login-form' action="/form" autocomplete="off">
						<!-- Campo oculto para asignar el id del registro al momento de modificar -->
						<input class="visually-hidden" type="number" id="idAdmon" name="idAdmon">
						<div class="d-flex flex-column justify-content-center align-items-center">
							<!-- Input Correo -->
							<div class="form-group mb-2">
								<label for="txtUsuario" class="mb-2 texto">Ingrese su usuario</label>
								<input type="text" class="form-control personalizacionPolus personalizacionPolusP"
									id="txtUsuario" name="txtUsuario" autocomplete="off" placeholder="Usuario"
									Required>
							</div>
							<!-- Input Contraseña -->
							<div class="form-group mb-2">
								<label for="contrasenia" class="mb-2 texto">Ingrese su contraseña</label>
								<input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1"
									id="txtContrasenia" name="txtContrasenia" autocomplete="off" placeholder="Contraseña" Required>
								<div class="form-check mt-3 mb-2">
									<input onChange="showHidePassword('chMostrarContraseña', 'txtContrasenia')" class="form-check-input" type="checkbox" value="" id="chMostrarContraseña">
									<label class="form-check-label text-dark" for="chMostrarContraseña">
										Mostrar Contraseña
									</label>
								</div>
								<a href="seleccion_recuperacion.php" class="form-text">¿Hás olvidado tu contraseña?</a>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-12 d-flex justify-content-center align-items-center">
								<button type="submit" class="btn boton my-2">Iniciar Sesión</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6 animate__animated animate__fadeInUp animate__faster">
					<img src="../../resources/img/loginfondo2.png" alt="" class="img-fluid imagenDesaparecer"
						width="400">
				</div>
			</div>
		</div>
	</div>

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
	</script>

	<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime el script para el movimiento del sidebar
dashboard_Page::sidebarTemplateMovement('index.js');
?>