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
									id="txtUsuario" name="txtUsuario" autocomplete="off" placeholder="Usuario" Required>
							</div>
							<!-- Input Contraseña -->
							<div class="form-group mb-2">
								<label for="contrasenia" class="mb-2 texto">Ingrese su contraseña</label>
								<input type="password"
									class="form-control personalizacionPolus personalizacionPolusP mb-1"
									id="txtContrasenia" name="txtContrasenia" autocomplete="off"
									placeholder="Contraseña" Required>
								<div class="form-check mt-3 mb-2">
									<input onChange="showHidePassword('chMostrarContraseña', 'txtContrasenia')"
										class="form-check-input" type="checkbox" value="" id="chMostrarContraseña">
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

	<!-- Modal para validar correo  -->
	<div class="modal fade" data-bs-backdrop="static" id="validarCorreo" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content justify-content-center px-3 py-2">
				<!-- Cabecera del Modal -->
				<div class="modal-header">
					<!-- Titulo -->
					<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
							class="fas fa-info-circle mx-2"></span>Factor de Doble Autenticación</h5>
				</div>
				<br>
				<!-- Contenido del Modal -->
				<div class="textoModal px-3 pb-4 mt-2">
					<div class="row px-3">
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<h4 class="alert-heading">¡Importante!</h4>
							<p>Debes verificar tu correo electrónico para poder recibir un código de verificación.
							</p>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					</div>
					<form id="validarCorreo-form" method="post" action="/form" autocomplete="off">
						<div class="row justify-content-center">
							<div class="d-flex justify-content-center col-12">
								<div class="d-flex flex-column">
									<div class="form-group formMiCuenta">
										<label for="txtCorreo" class="form-label mt-2">Correo Electrónico:</label>
										<div class="d-flex">
											<input type="hidden" id="idAdmonCorreo" name="idAdmonCorreo">
											<input onChange="checkCorreo('txtCorreo')" type="email"
												class="form-control inputMiCuenta" id="txtCorreo" maxlength="80"
												name="txtCorreo" Required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center mt-4">
							<div class="col-12 d-flex justify-content-center">
								<button type="submit" class="btn btn-outline-dark">Verificar</button>
							</div>
						</div>
					</form>
					<!-- Fin del Contenido del Modal -->
				</div>
			</div>
		</div>
	</div>
	<!-- Fin del Modal -->

	<!-- Modal para ingresar codigo de verificacion -->
	<div class="modal fade" data-bs-backdrop="static" id="validarCodigo" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content justify-content-center px-3 py-2">
				<!-- Cabecera del Modal -->
				<div class="modal-header">
					<!-- Titulo -->
					<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
							class="fas fa-info-circle mx-2"></span>Factor de Doble Autenticación</h5>
				</div>
				<br>
				<!-- Contenido del Modal -->
				<div class="textoModal px-3 pb-4 mt-2">
					<div class="row px-3">
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<h4 class="alert-heading">¡Importante!</h4>
							<p>Verifica en tu correo electrónico el código de 6 digitos enviado.
							</p>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					</div>
					<form id="validarCodigo-form" method="post" action="/form" autocomplete="off">
						<div class="row justify-content-center">
							<div class="d-flex justify-content-center col-12">
								<div class="d-flex flex-column">
									<div class="form-group formMiCuenta">
										<label for="txtCodigo" class="form-label mt-2">Código de Verificacion:</label>
										<div class="d-flex">
											<input onChange="checkTelefono('txtCodigo')" type="text"
												class="form-control inputMiCuenta" id="txtCodigo" maxlength="6"
												name="txtCodigo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" Required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center mt-4">
							<div class="col-12 d-flex justify-content-center">
								<button type="submit" class="btn btn-outline-dark">Iniciar Sesión</button>
							</div>
						</div>
					</form>
					<!-- Fin del Contenido del Modal -->
				</div>
			</div>
		</div>
	</div>
	<!-- Fin del Modal -->


	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="../../resources/js/chart.min.js"></script>
	<script type="text/javascript" src="../../app/helpers/components.js"></script>
	<script type="text/javascript" src="../../app/controllers/dashboard/index.js"></script>
