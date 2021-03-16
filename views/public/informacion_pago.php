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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <!-- Hoja de Estilos -->
    <link rel="stylesheet" href="../../resources/css/informacion_pago_estilos.css">
    <title>Polus - Iniciar Sesión</title>
  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados">
        <div class="row">
            <div class="col-12">
                <img src="../../resources/img/informacionPago.png" id="imagenInicio" class="img-fluid centrarImagenes">
            </div>
        </div>
        <div class="row">
            <h1 class="titulo my-4">Verifique su información:</h1>
            <div class="col-12 mb-2">
                <label class="texto mb-2">Dirección de Envió:</label>
                <textarea class="form-control personalizacionPolus" aria-label="With textarea"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                <label for="exampleInputEmail1" class="mb-2 texto">Nombre:</label>
                <input type="text" class="form-control personalizacionPolus" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Eduardo Rivera">
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                <label for="exampleInputEmail1" class="mb-2 texto">Teléfono:</label>
                <input type="text" class="form-control personalizacionPolus" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0000-0000">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
              <a class="btn boton mt-4 mb-2">Aceptar</a>
            </div>
          </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>