<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus | Mi Cuenta','.');
?>

<div class="container-fluid" style="background-color: #22242C;">
    <!-- Contenido -->
	<div class="row pt-5">
		<div class="col-12">
			<h1 class="tituloMiCuenta text-white animate__animated animate__fadeInUp animate__faster">INFORMACIÓN PERSONAL</h1>
		</div>
	</div>
    <form autocomplete="off" action="/form" method="post" id="micuenta-form">
        <div class="row mt-3 justify-content-center animate__animated animate__fadeInUp animate__faster ">
			<div class="col-12 d-flex flex-column justify-content-center align-items-center">
				<div class="d-flex flex-column justify-content-center align-items-center">
					<div class="bordeDivFotografia">
						<div class="divFotografia" id="divFoto">

						</div>
					</div>
					<div id="btnAgregarFoto" class="mt-4">
						<button class="btn btn-outline-light" id="botonFoto"><span class="fas fa-plus"></span></button>
					</div>
					<input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario"
						accept=".gif, .jpg, .png">
				</div>
			</div>
		</div>

        <div class="row mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-xl-end justify-content-md-end justify-content-sm-center justify-content-xs-center justify-content-center">
                <div class="form-group">
                    <label for="txtNombre" class="mb-2 texto">Nombres:</label>
                    <input type="text" maxlength="25" onchange="checkInputLetras('txtNombre')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                        id="txtNombre" name="txtNombre" placeholder="Juan Armando" Required>

                    <label for="txtTelefono" class="mb-2 texto">Teléfono:</label>
                    <input type="text" maxlength="9" onchange="checkTelefono('txtTelefono')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                        id="txtTelefono" name="txtTelefono" placeholder="0000-0000" Required>

                    <label for="txtFechaNacimiento" class="mb-2 texto">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                        id="txtFechaNacimiento" name="txtFechaNacimiento" Required>

                    <label for="txtGenero" class="mb-2 texto">Género:</label>
                        <select id="txtGenero" name="txtGenero"
                            class="form-select personalizacionPolus personalizacionPolusP"
                            aria-label="Default select example">
                            <option selected>Seleccionar...</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                </div>
            </div>
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-xl-start justify-content-md-start justify-content-sm-center justify-content-xs-center justify-content-center">
                <div class="form-group">
                    <label for="txtApellido" class="mb-2 texto">Apellidos:</label>
                    <input type="text" maxlength="25" onchange="checkInputLetras('txtApellido')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                        id="txtApellido" name="txtApellido" placeholder="Perez Castro" Required>
                    
                    <label for="txtDireccion" class="mb-2 texto">Dirección:</label>
                    <textarea maxlength="200" onchange="checkDireccion('txtDireccion')" class="form-control personalizacionPolus personalizacionPolusP mb-1" rows=8
                        id="txtDireccion" name="txtDireccion" Required></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-2 pb-4 justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-outline-light">Confirmar</button>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid">
    <div class="row mt-5 animate__animated animate__fadeInUp animate__faster">
		<div class="col-12">
			<h1 class="tituloMiCuenta text-white">AJUSTES DE LA CUENTA</h1>
		</div>
	</div>
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="form-group">
                <h6 class="text-white">
                    Usuario <br>
                    <small class="text-muted" id="lblUsuario"></small>
                </h6>
                <h6 class="text-white">
                    Correo Electrónico <br>
                    <small class="text-muted" id="lblCorreo"></small>
                </h6>
                <h6 class="text-white">
                    Contraseña <br>
                    <small class="text-muted">*********</small>
                </h6>
            </div>
        </div>
    </div>
    <div class="row mt-2 pb-4 justify-content-center mt-4 animate__animated animate__fadeInUp animate__faster">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <button data-bs-toggle="modal" data-bs-target="#seleccionarAjuste" class="btn btn-outline-light">Actualizar Ajustes</button>
        </div>
    </div>
</div>

<!-- Modal para seleccionar un ajuste a cambiar -->
<div class="modal fade" id="seleccionarAjuste" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span class="fas fa-info-circle mx-3 text-white"></span>Actualizar Ajustes de la Cuenta</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
					<div class="d-flex justify-content-xl-end mt-2 justify-content-md-end justify-content-center col-xl-4 col-md-6 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarUsuario" class="btn btn-outline-light tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-user fs-3"></i>
								Usuario
							</button>
						</div>
					</div>
					<div class="d-flex justify-content-center justify-content-xl-center mt-2 justify-content-md-start justify-content-sm-center justify-content-xl-center col-xl-4 col-md-6 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarCorreo" class="btn btn-outline-light tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-envelope fs-3"></i>
								Correo
							</button>
						</div>
					</div>
					<div class="d-flex justify-content-xl-start justify-content-center mt-2 col-xl-4 col-md-12 col-sm-12 col-xs-12">
						<div>
							<button data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#cambiarContraseña" class="btn btn-outline-light tamañoBotonesMiCuenta d-flex flex-column justify-content-center align-items-center">
								<i class="fas fa-key fs-3"></i>
								Clave
							</button>
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar el usuario -->
<div class="modal fade" id="cambiarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span
                        class="fas fa-info-circle mx-3 text-white"></span>Actualizar Usuario</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row px-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">¡Importante!</h4>
                        <p class="text-dark">Asegurate de colocar un usuario valido (Carácteres alfanúmericos).</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <form id="updateUser-form" method="post" action="/form" autocomplete="off">
                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center col-12">
                            <div class="d-flex flex-column">
                                <div class="form-group formMiCuenta">
                                <label for="txtNuevoUsuario" class="mb-2 texto">Nuevo Usuario:</label>
                                    <div class="d-flex">
                                        <input type="text" maxlength="25" onchange="checkAlfanumerico('txtNuevoUsuario')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtNuevoUsuario" name="txtNuevoUsuario" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txtConfirmarUsuario" class="mb-2 texto">Confirmar Usuario:</label>
                                    <div class="d-flex">
                                        <input type="text" maxlength="25" onchange="checkAlfanumerico('txtConfirmarUsuario')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtConfirmarUsuario" name="txtConfirmarUsuario" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txtContraseñaUsuario" class="mb-2 texto">Contraseña:</label>
                                    <div class="d-flex">
                                        <input type="password" maxlength="15" onchange="checkContrasena('txtContraseñaUsuario')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtContraseñaUsuario" name="txtContraseñaUsuario" Required>
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

<!-- Modal para cambiar el correo -->
<div class="modal fade" id="cambiarCorreo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span
                        class="fas fa-info-circle mx-3 text-white"></span>Actualizar Correo Electrónico</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row px-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">¡Importante!</h4>
						<p class="text-dark">Asegurate de colocar un correo eletrónico valido.</p>				
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
                </div>
                <form id="updateEmail-form" method="post" action="/form" autocomplete="off">
                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center col-12">
                            <div class="d-flex flex-column">
                                <div class="form-group formMiCuenta">
                                <label for="txtNuevoEmail" class="mb-2 texto">Nuevo Correo:</label>
                                    <div class="d-flex">
                                        <input type="email" maxlength="80" onchange="checkCorreo('txtNuevoEmail')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtNuevoEmail" name="txtNuevoEmail" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txtConfirmarCorreo" class="mb-2 texto">Confirmar Correo:</label>
                                    <div class="d-flex">
                                        <input type="email" maxlength="80" onchange="checkCorreo('txtConfirmarCorreo')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtConfirmarCorreo" name="txtConfirmarCorreo" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txtContraseñaCorreo" class="mb-2 texto">Contraseña:</label>
                                    <div class="d-flex">
                                        <input type="password" maxlength="15" onchange="checkContrasena('txtContraseñaCorreo')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtContraseñaCorreo" name="txtContraseñaCorreo" Required>
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

<!-- Modal para cambiar contraseña   -->
<div class="modal fade" id="cambiarContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span
                        class="fas fa-info-circle mx-3 text-white"></span>Actualizar Contraseña</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="row px-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">¡Importante!</h4>
						<p class="text-dark">Tu contraseña debe de cumplir con los siguientes requisitos: </p>
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
                                <label for="txtContraseñaActual" class="mb-2 texto">Contraseña Actual:</label>
                                    <div class="d-flex">
                                        <input type="password" maxlength="15" onchange="checkContrasena('txtContraseñaActual')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtContraseñaActual" name="txtContraseñaActual" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txt" class="mb-2 texto">Nueva Contraseña:</label>
                                    <div class="d-flex">
                                        <input type="password" maxlength="15" onchange="checkContrasena('txtNuevaContraseña')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtNuevaContraseña" name="txtNuevaContraseña" Required>
                                    </div>
                                </div>

                                <div class="form-group formMiCuenta">
                                <label for="txtConfirmarCorreo" class="mb-2 texto">Confirmar Contraseña:</label>
                                    <div class="d-flex">
                                        <input type="password" maxlength="15" onchange="checkContrasena('txtConfirmarContraseña')" class="form-control mb-2 personalizacionPolus personalizacionPolusP"
                                        id="txtConfirmarContraseña" name="txtConfirmarContraseña" Required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="form-check mt-3 mb-2">
                                <input onChange="showHidePassword3('chMostrarContraseña', 'txtContraseñaActual', 'txtNuevaContraseña', 'txtConfirmarContraseña')" class="form-check-input" type="checkbox" value="" id="chMostrarContraseña">
                                <label class="form-check-label text-white" for="chMostrarContraseña">
                                    Mostrar Contraseña
                                </label>
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


<?php
public_Page::footerTemplate('ajustes_cuenta.js');
?>