<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
	<link rel="stylesheet" href="../../resources/css/iniciar_sesion_publico.css">
	<link rel="stylesheet" href="../../resources/css/index_publico_styles.css">
	<title>Polus - Iniciar Sesión</title>
</head>

<body>
	<!-- Fondo -->
	<div id="background">
		<!-- Caja -->
		<div id="form" class="paddingLados animate__animated animate__fadeInUp animate__faster p-3">
			<div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
				<!-- Columna 1 -->
				<div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 paddingLados">
					<h1 class="titulo2 mb-2 mt-3 pt-5">Iniciar Sesión</h1>
					<div class="form-group">
						<form id="login-form" action="/form" autocomplete="off">
						<!-- Campo oculto para asignar el id del registro al momento de modificar -->
						<input class="visually-hidden" type="number" id="idCliente" name="idCliente">
							<div class="d-flex flex-column justify-content-center align-items-center">
								<!-- Input Correo -->
								<div class="form-group mb-2">
									<label for="exampleInputEmail1" class="mb-2 texto">Ingrese su correo</label>
									<input type="email" class="form-control personalizacionPolus personalizacionPolusP"
										id="correo" name="correo" autocomplete="off"
										placeholder="ejemplo@mail.com" Required>
								</div>
								<!-- Input Contraseña -->
								<div class="form-group mb-2">
									<label for="exampleInputPassword1" class="mb-2 texto">Ingrese su contraseña</label>
									<input type="password"
										class="form-control personalizacionPolus personalizacionPolusP mb-1"
										id="contrasenia" name="contrasenia" autocomplete="off" placeholder="Contraseña" Required>
									<div class="form-check mt-3 mb-2">
										<input onChange="showHidePassword('chMostrarContraseña', 'contrasenia')" class="form-check-input" type="checkbox" value="" id="chMostrarContraseña">
										<label class="form-check-label text-white" for="chMostrarContraseña">
											Mostrar Contraseña
										</label>
									</div>
									<a href="ingresar_correo_recuperacion.php" class="form-text">¿Hás olvidado tu contraseña?</a>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-12 d-flex justify-content-center align-items-center">
									<button class="btn boton my-2" type='submit' id="btnCancelar">Iniciar
										Sesion</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<img src="../../resources/img/loginfondo.png" alt="" class="img-fluid imagenDesaparecer"
						width="400">
				</div>
			</div>
		</div>
	</div>

	<!-- Modal para cambiar el usuario -->
<div class="modal fade" id="validarCodigo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span
                        class="fas fa-info-circle mx-3 text-white"></span>Factor de Doble Autenticación</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row px-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">¡Importante!</h4>
                        <p class="text-dark">Verifica tu correo electrónico para obtener el código de verificación</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <form id="validarCodigo-form" method="post" action="/form" autocomplete="off">
                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center col-12">
                            <div class="d-flex flex-column">
                                <div class="form-group formMiCuenta mt-2">
                                <label for="txtCodigo" class="mb-2 texto">Código de Verificación:</label>
                                    <div class="d-flex">
                                        <input type="text" maxlength="6" onchange="checkContrasena('txtCorreo')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtCodigo" name="txtCodigo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" Required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-light">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../app/controllers/public/iniciar_sesion.js"></script>
	<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="../../app/helpers/components.js"></script>