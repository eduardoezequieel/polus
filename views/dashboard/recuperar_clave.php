<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../resources/css/iniciar_sesion_privado.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">

    <title>Cambiar clave | Polus</title>
</head>

<body>
    <!-- Contenedor Principal -->
    <div class="flex-column" id="container2">

        <div class="row mt-3 mb-2">
            <div class="col-12">
                <h1 class="titulo text-center">Reestablecer Contraseña</h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-12">
                <h1 class="tituloDato text-center px-4">Puedes reestablecer tu clave en el siguiente formulario.</h1>
            </div>
        </div>

        <form id="primeruso-form" method="post">
            <div class="d-flex justify-content-center align-items-center">
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
            <div class="row justify-content-center">
                <div
                    class="col-xl-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="txtContrasena" class="tituloCajaTextoFormulario">Nueva Contraseña:</label>
                            <input type="password" name="txtNuevaContraseña" id="txtNuevaContraseña"
                                class="form-control cajaTextoFormulario widthRegister"
                                onchange="checkContrasena('txtNuevaContraseña')" Required>
                        </div>

                        <div class="form-group">
                            <label for="txtContrasena" class="tituloCajaTextoFormulario">Confirmar Contraseña:</label>
                            <input type="password" name="txtConfirmarContraseña" id="txtConfirmarContraseña"
                                class="form-control cajaTextoFormulario widthRegister"
                                onchange="checkContrasena('txtConfirmarContraseña')" Required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
						<div class="col-12 d-flex justify-content-center">
							<div class="form-check">
								<input id="chMostrarContraseña"  onChange="showHidePassword1('chMostrarContraseña', 'txtNuevaContraseña', 'txtConfirmarContraseña')" class="form-check-input" type="checkbox" value="" >
								<label class="form-check-label" for="chMostrarContraseña">
									Mostrar Contraseña
								</label>
							</div>
						</div>
				</div>
                <div class="row justify-content-center my-4">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn boton"><span
                                class="fas fa-check mx-1"></span>Finalizar</button>
                    </div>
                </div>
        </form>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../app/controllers/dashboard/recuperar_clave.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
</body>

</html>