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
    <link rel="stylesheet" href="../../resources/css/ingresar_codigo_telefono_estilos.css">
    <title>Polus - Recuperacion Contraseña</title>

  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
        <!-- Caja -->
      <div id="form">
          <!-- Imagen -->
        <img src="../../resources/img/codigoTelefono.png" alt="" class="img-fluid centrarImagenes" id="imagenInicio">
        <h1 class="titulo">Ingresa tu código</h1>
        <p class="texto2 mt-3">Has recibido un código en tu teléfono, por favor colocalo aquí para <br> continuar con la recuperación de contraseña.</p>
        <!-- Texto -->
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="">
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="">
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="">
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center minimizarDiv">
                <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="">
            </div>

        </div>

        <!-- Boton -->
        <div class="row mt-3">
            <div class="col col-12 d-flex justify-content-center align-items-center">
                <a href="recuperar_contraseña.php" class="btn boton2">Siguiente</a>
            </div>
        </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>