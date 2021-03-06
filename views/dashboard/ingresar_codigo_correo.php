<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">             
    <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    
    <!-- Hoja de Estilos -->
    <link rel="stylesheet" href="../../resources/css/ingresar_codigo_correo_estilos.css">
    <title>Polus - Recuperacion Contraseña</title>

  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
        <!-- Caja -->
      <div id="formDash">
          <form id="codigo-form" action="/form" autocomplete="off">
            <!-- Imagen -->
            <img src="../../resources/img/codigoCorreo.png" alt="" class="img-fluid centrarImagenes" id="imagenInicio">
            <h1 class="titulo1">Ingresa tu código</h1>
            <p class="texto3 mt-3">Has recibido un código en tu correo eletrónico, por favor colocalo aquí para <br> continuar con la recuperación de contraseña.</p>
            <!-- Texto -->
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                    <input type="text" id="1" maxlength="1" class="form-control personalizacionPolus m-1" placeholder="" required>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                    <input type="text" id="2" maxlength="1" class="form-control personalizacionPolus m-1" placeholder="" required>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                    <input type="text" id="3" maxlength="1" class="form-control personalizacionPolus m-1" placeholder="" required>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                    <input type="text" id="4" maxlength="1" class="form-control personalizacionPolus m-1" placeholder="" required>
                </div>
                <input class="visually-hidden" type="text" id="tokeningresado" name="tokeningresado" maxlength="1" class="form-control personalizacionPolus2 m-1" placeholder="">
            </div>

            <!-- Boton -->
            <div class="row mt-3">
                <div class="col col-12 d-flex justify-content-center align-items-center">
                  <button class="btn boton my-2" type='submit' id="btnCancelar">Siguiente</button>
                </div>
            </div>
            </div>
          </form>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../app/controllers/dashboard/ingresar_codigo_correo.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
  </body>
</html>