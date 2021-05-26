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
    <title>Polus - Iniciar Sesión</title>
  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados animate__animated animate__fadeInUp animate__faster">
        <div class="row py-4 justify-content-center animate__animated animate__fadeInUp animate__faster">
          <!-- Columna 1 -->
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center flex-column paddingLados ">
                <h1 class="titulo2 mb-2 mt-5 pt-5">Iniciar Sesión</h1>
                <div class="form-group">
                <form>
                  <!-- Input Correo -->
                  <div class="form-group mb-2">
                    <label for="exampleInputEmail1" class="mb-2 texto">Ingrese su correo electrónico</label>
                    <input type="email" class="form-control personalizacionPolus personalizacionPolusP" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ejemplo@mail.com">
                  </div>
                  <!-- Input Contraseña -->
                  <div class="form-group mb-2">
                    <label for="exampleInputPassword1" class="mb-2 texto">Ingrese su contraseña</label>
                    <input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="exampleInputPassword1" placeholder="Contraseña">
                    <a href="seleccion_recuperacion.php" class="form-text">¿Hás olvidado tu contraseña?</a>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                      <a href="pagina_principal.php" class="btn boton my-2">Iniciar Sesión</a>
                    </div>
                  </div>
                </form>
                </div>
            </div>
            <div class="col-md-6">
                <img src="../../resources/img/loginfondo.png" alt="" class="img-fluid imagenDesaparecer" width="400">
            </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>