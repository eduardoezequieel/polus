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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">          
    <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Hoja de Estilos -->
    <link rel="stylesheet" href="../../resources/css/iniciar_sesion_privado.css">
    <title>Polus - Iniciar Sesión</title>
  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados animate__animated animate__fadeInUp animate__faster">
        <div class="row">
          <div class="col-12">
            <h1 class="titulo2 text-center m-4">Creación del Primer Usuario</h1>
          </div>
        </div>
        <div class="row animate__animated animate__fadeInUp animate__faster">
          <!-- Columna 1 -->
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 paddingLados">
                <form>
                    <div class="form-group mb-2">
                      <label for="txtNombre" class="mb-2 texto">Nombres:</label>
                      <input type="text" class="form-control personalizacionPolus personalizacionPolusP" id="txtNombre" placeholder="Juan Armando">
                    </div>
                    <div class="form-group mb-2">
                      <label for="txtEmail" class="mb-2 texto">Correo Electrónico:</label>
                      <input type="email" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtEmail" placeholder="ejemplo@mail.com">
                    </div>
                    <div class="form-group mb-2">
                      <label for="txtContraseña" class="mb-2 texto">Contraseña:</label>
                      <input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtContraseña" placeholder="Contraseña">
                    </div>
                    
                  </form>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 paddingLados animate__animated animate__fadeInUp animate__faster">
            <form>
                    <div class="form-group mb-2">
                      <label for="txtApellidos" class="mb-2 texto">Apellidos:</label>
                      <input type="text" class="form-control personalizacionPolus personalizacionPolusP" id="txtApellidos" aria-describedby="emailHelp" placeholder="Hernández Perez">
                    </div>
                    <div class="form-group mb-2">
                      <label for="txtUsuario" class="mb-2 texto">Usuario</label>
                      <input type="text" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtUsuario" placeholder="usuario123">                    
                    </div>
                    <div class="form-group mb-2">
                      <label for="txtConfirmarContraseña" class="mb-2 texto">Confirmar Contraseña:</label>
                      <input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtConfirmarContraseña" placeholder="Confirmar Contraseña">                    
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 d-flex justify-content-center align-items-center">
                        
                      </div>
                    </div>
                  </form>
            </div>
        </div>

        <div class="row justify-content-cente animate__animated animate__fadeInUp animate__faster m-4">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <a href="pagina_dashboard.php" class="btn boton my-2">Crear Usuario</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>