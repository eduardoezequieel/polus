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
    <link rel="stylesheet" href="../../resources/css/ingresar_correo_recuperacion_estilos.css">
    <title>Polus - Confirmar Email</title>

  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
        <!-- Caja -->
      <div id="formDash">
        <form id="correo-form" action="/form" autocomplete="off">
          <!-- Texto -->
          <h1 class="titulo1">Escribe tu Correo <br> Electrónico</h1>
          <p class="texto3 mt-3">Para poder continuar con la recuperación de tu contraseña, <br> escribe tu dirección de correo  eletrónico.</p>
          <!-- Input -->
          <div class="row d-flex justify-content-center align-items-center">
              <div class="col d-flex justify-content-center align-items-center">
                  <input type="email" id="correo" name="correo" class="form-control personalizacionPolus m-1" placeholder="ejemplo@mail.com" onchange="checkCorreo('correo')" required>
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
    <script type="text/javascript" src="../../app/controllers/dashboard/ingresar_correo_recuperacion.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
  </body>
</html>