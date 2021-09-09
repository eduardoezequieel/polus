<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Mi Cuenta',' ');
?>
<!--Fin del sidebar-->
<!-- Contenido de la Pagina -->
<div class="page-content p-5" id="content">
	<!-- Contenedor de la barra inicial -->
	<?php
		//Se imprime la plantilla la barra inicial
		dashboard_Page::barraInicial();
		?>
	<!-- Contenido -->
	<div class="row mt-3">
		<div class="col-12">
			<h1 class="tituloMiCuenta animate__animated animate__fadeInUp animate__faster">INFORMACIÓN PERSONAL</h1>
		</div>
	</div>

	<form method="post" id="info-form" action="/form" autocomplete="off">
		<div class="row mt-3 justify-content-center animate__animated animate__fadeInUp animate__faster ">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center">
				<div class="d-flex flex-column justify-content-center align-items-center">
					<div class="bordeDivFotografia">
						<div class="divFotografia" id="divFoto">

						</div>
					</div>
					<div id="btnAgregarFoto" class="mt-4">
						<button class="btn btn-outline-dark" id="botonFoto"><span class="fas fa-plus"></span></button>
					</div>
					<input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario"
						accept=".gif, .jpg, .png">
				</div>
			</div>
		</div>

		<div class="row mt-4 animate__animated animate__fadeInUp animate__faster">
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end centrarContenido">
				<div class="form-group formMiCuenta">
					<label for="nombre" class="form-label mt-2">Nombres:</label>
					<input type="text" class="form-control inputMiCuenta" id="txtNombre" name="txtNombre" Required>

					<label for="telefono" class="form-label mt-2">Teléfono:</label>
					<input type="text" class="form-control inputMiCuenta" id="txtTelefono" name="txtTelefono" Required>

					<label for="fechaNacimiento" class="form-label mt-2">Fecha de Nacimiento:</label>
					<input type="date" class="form-control inputMiCuenta" id="txtfechaNacimiento" name="txtfechaNacimiento"
						Required>

					<div class="mt-2">
						<label for="txtGenero" class="form-label">Género:</label>
						<select id="txtGenero" name="txtGenero" class="form-select" aria-label="Default select example"
							Required>
							<option selected>Seleccionar...</option>
							<option value="Femenino">Femenino</option>
							<option value="Masculino">Masculino</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start centrarContenido">
				<div class="form-group formMiCuenta">
					<label for="apellido" class="form-label mt-2">Apellidos:</label>
					<input type="text" class="form-control inputMiCuenta" id="txtApellidos" name="txtApellidos" Required>

					<label for="Dirección" class="form-label mt-2">Dirección:</label>
					<textarea class="form-control textareaMiCuenta" id="txtDireccion" name="txtDireccion"
						Required></textarea>
				</div>
			</div>
		</div>

		<div class="row justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center">
				<button type="submit" class="btn btn-outline-dark">Confirmar</button>
			</div>
		</div>
	</form>

	<div class="row mt-5 animate__animated animate__fadeInUp animate__faster">
		<div class="col-12">
			<h1 class="tituloMiCuenta">AJUSTES DE LA CUENTA</h1>
		</div>
	</div>

	<form method="post" id="cuenta-form">
		<div class="row justify-content-end mt-4 animate__animated animate__fadeInUp animate__faster">
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-end align-items-end centrarContenido">
				<div class="form-group formMiCuenta">
					<label for="nombre" class="form-label mt-2">Usuario:</label>
					<input type="text" class="form-control inputMiCuenta" id="txtUsuario" name="txtUsuario" Required readonly>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-start align-items-start centrarContenido">
				<div class="form-group formMiCuenta">
					<label for="telefono" class="form-label mt-2">Correo Electrónico:</label>
					<input type="text" class="form-control inputMiCuenta" id="txtEmail" name="txtEmail" Required readonly>
				</div>
			</div>
		</div>

		<div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center">
				<div class="form-group formMiCuenta">
					<label for="apellido" class="form-label mt-2">Contraseña:</label>
					<input type="password" readonly class="form-control inputMiCuenta" id="txtContrasenia" name="txtContrasenia">
				</div>
			</div>
		</div>

		<div class="row justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center">
				<button type="button" data-bs-toggle="modal" data-bs-target="#administrarAjustes" class="btn btn-outline-dark">Actualizar Ajustes</button>
			</div>
		</div>
	</form>
	<!-- Final del contenido -->
</div>

<!-- Modal para Administrar Ajustes de la Cuenta -->
<div class="modal fade" id="administrarAjustes" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content justify-content-center px-3 py-2">
			<!-- Cabecera del Modal -->
			<div class="modal-header">
				<!-- Titulo -->
				<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
						class="fas fa-info-circle mx-2"></span>Actualizar Ajustes de la Cuenta</h5>
				<!-- Boton para Cerrar -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<br>
			<!-- Contenido del Modal -->
			<div class="textoModal px-3 pb-4 mt-2">
				<div class="row justify-content-center">
					<div class="d-flex justify-content-xl-end mt-2 justify-content-md-end justify-content-center col-xl-4 col-md-6 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarUsuario" class="btn btn-outline-dark tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-user fs-3"></i>
								Usuario
							</button>
						</div>
					</div>
					<div class="d-flex justify-content-center justify-content-xl-center mt-2 justify-content-md-start justify-content-sm-center justify-content-xl-center col-xl-4 col-md-6 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarCorreo" class="btn btn-outline-dark tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-envelope fs-3"></i>
								Correo
							</button>
						</div>
					</div>
					<div class="d-flex justify-content-xl-start justify-content-center mt-2 col-xl-4 col-md-12 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarContraseña" class="btn btn-outline-dark tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-key fs-3"></i>
								Clave
							</button>
						</div>
					</div>
				</div>
				<!-- Fin del Contenido del Modal -->
			</div>
		</div>
	</div>
</div>
<!-- Fin del Modal -->

<!-- Modal para cambiar el usuario  -->
<div class="modal fade" id="cambiarUsuario" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content justify-content-center px-3 py-2">
			<!-- Cabecera del Modal -->
			<div class="modal-header">
				<!-- Titulo -->
				<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
						class="fas fa-info-circle mx-2"></span>Actualizar Usuario</h5>
				<!-- Boton para Cerrar -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<br>
			<!-- Contenido del Modal -->
			<div class="textoModal px-3 pb-4 mt-2">
				<div class="row px-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">¡Importante!</h4>
						<p>Asegurate de colocar un usuario valido (Carácteres alfanúmericos).</p>				
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
				<form id="updateUser-form" method="post" action="/form" autocomplete="off">
					<div class="row justify-content-center">
						<div class="d-flex justify-content-center col-12">
							<div class="d-flex flex-column">
								<div class="form-group formMiCuenta">
									<label for="txtNuevoUsuario" class="form-label mt-2">Nuevo Usuario:</label>
									<div class="d-flex">
										<input onChange="checkAlfanumerico('txtNuevoUsuario')" type="text" class="form-control inputMiCuenta" id="txtNuevoUsuario" maxlength="25" name="txtNuevoUsuario" Required >
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtConfirmarUsuario" class="form-label mt-2">Confirmar Usuario:</label>
									<div class="d-flex">
										<input onChange="checkAlfanumerico('txtConfirmarUsuario')" type="text" class="form-control inputMiCuenta" id="txtConfirmarUsuario" maxlength="25" name="txtConfirmarUsuario" Required >
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtContraseñaUsuario" class="form-label mt-2">Contraseña:</label>
									<div class="d-flex">
										<input onChange="checkContrasena('txtContraseñaUsuario')" type="password" class="form-control inputMiCuenta" id="txtContraseñaUsuario" maxlength="15" name="txtContraseñaUsuario" Required >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-outline-dark">Guardar Cambios</button>
						</div>
					</div>
				</form>
				<!-- Fin del Contenido del Modal -->
			</div>
		</div>
	</div>
</div>
<!-- Fin del Modal -->

<!-- Modal para cambiar el correo  -->
<div class="modal fade" id="cambiarCorreo" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content justify-content-center px-3 py-2">
			<!-- Cabecera del Modal -->
			<div class="modal-header">
				<!-- Titulo -->
				<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
						class="fas fa-info-circle mx-2"></span>Actualizar Correo</h5>
				<!-- Boton para Cerrar -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<br>
			<!-- Contenido del Modal -->
			<div class="textoModal px-3 pb-4 mt-2">
				<div class="row px-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">¡Importante!</h4>
						<p>Asegurate de colocar un correo eletrónico valido.</p>				
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
				<form id="updateEmail-form" method="post" action="/form" autocomplete="off">
					<div class="row justify-content-center">
						<div class="d-flex justify-content-center col-12">
							<div class="d-flex flex-column">
								<div class="form-group formMiCuenta">
									<label for="txtNuevoCorreo" class="form-label mt-2">Correo Electrónico:</label>
									<div class="d-flex">
										<input onChange="checkCorreo('txtNuevoCorreo')" type="email" class="form-control inputMiCuenta" id="txtNuevoCorreo" maxlength="80" name="txtNuevoCorreo" Required >
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtConfirmarCorreo" class="form-label mt-2">Confirmar Correo:</label>
									<div class="d-flex">
										<input onChange="checkCorreo('txtConfirmarCorreo')" type="email" class="form-control inputMiCuenta" id="txtConfirmarCorreo" maxlength="80" name="txtConfirmarCorreo" Required >
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtContraseñaCorreo" class="form-label mt-2">Contraseña:</label>
									<div class="d-flex">
										<input onChange="checkContrasena('txtContraseñaCorreo')" type="password" class="form-control inputMiCuenta" id="txtContraseñaCorreo" maxlength="15" name="txtContraseñaCorreo" Required >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-outline-dark">Guardar Cambios</button>
						</div>
					</div>
				</form>
				<!-- Fin del Contenido del Modal -->
			</div>
		</div>
	</div>
</div>
<!-- Fin del Modal -->

<!-- Modal para cambiar la contraseña -->
<div class="modal fade" id="cambiarContraseña" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content justify-content-center px-3 py-2">
			<!-- Cabecera del Modal -->
			<div class="modal-header">
				<!-- Titulo -->
				<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
						class="fas fa-info-circle mx-2"></span>Actualizar Contraseña</h5>
				<!-- Boton para Cerrar -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<br>
			<!-- Contenido del Modal -->
			<div class="textoModal px-3 pb-4 mt-2">
				<div class="row px-3">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">¡Importante!</h4>
						<p>Tu contraseña debe de cumplir con los siguientes requisitos: </p>
						<hr>
							- Minimo 8 caracteres <br>
							- Maximo 15 <br>
							- Al menos una letra mayúscula <br>
							- Al menos una letra minucula <br>
							- Al menos un dígito <br>
							- No espacios en blanco <br>
							- Al menos 1 caracter especial					
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
				<form id="updatePassword-form" method="post" action="/form" autocomplete="off">
					<div class="row justify-content-center">
						<div class="d-flex justify-content-center col-12">
							<div class="d-flex flex-column">
							<div class="form-group formMiCuenta">
									<label for="txtActualContraseña" class="form-label mt-2">Contraseña Actual:</label>
									<div class="d-flex">
										<input onChange="checkContrasena('txtActualContraseña')" type="password" class="form-control inputMiCuenta" id="txtActualContraseña" maxlength="15" name="txtActualContraseña" Required >	
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtNuevaContraseña" class="form-label mt-2">Nueva Contraseña:</label>
									<div class="d-flex">
										<input onChange="checkContrasena('txtNuevaContraseña')" type="password" class="form-control inputMiCuenta" id="txtNuevaContraseña" maxlength="15" name="txtNuevaContraseña" Required >	
									</div>
								</div>

								<div class="form-group formMiCuenta">
									<label for="txtConfirmarContraseña" class="form-label mt-2">Confirmar Contraseña:</label>
									<div class="d-flex">
										<input onChange="checkContrasena('txtConfirmarContraseña')" type="password" class="form-control inputMiCuenta" id="txtConfirmarContraseña" maxlength="15" name="txtConfirmarContraseña" Required >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-12 d-flex justify-content-center">
							<div class="form-check">
								<input onChange="showHidePassword1('chMostrarContraseña', 'txtActualContraseña', 'txtNuevaContraseña', 'txtConfirmarContraseña')" class="form-check-input" type="checkbox" value="" id="chMostrarContraseña">
								<label class="form-check-label" for="chMostrarContraseña">
									Mostrar Contraseña
								</label>
							</div>
						</div>
					</div>
					<div class="row justify-content-center mt-4">
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-outline-dark">Guardar Cambios</button>
						</div>
					</div>
				</form>
				<!-- Fin del Contenido del Modal -->
			</div>
		</div>
	</div>
</div>
<!-- Fin del Modal -->
<!-- Bootstrap core JavaScript -->
<?php
//Se imprime el script para las direcciones de Bootstrap core JavaScript
dashboard_Page::scriptBTJS();
?>

<!-- Movimiento sidebar -->
<?php
//Se imprime el script para el movimiento del sidebar
dashboard_Page::sidebarTemplateMovement('mi_cuenta.js');
?>