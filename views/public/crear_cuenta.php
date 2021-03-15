<!doctype html>
<html lang="en">
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
    <link rel="stylesheet" href="../../resources/css/crear_cuenta_publico.css">
    <title>Polus - Registrate</title>
  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados">
        <div class="row">
          <!-- Columna 1 -->
            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 paddingLados">
                <h1 class="titulo margenTexto">Crear Cuenta</h1>
                <!-- Datos Personales -->
                <form>
                  <p class="texto">Datos Personales</p>
                  <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="" class="texto2">Nombres</label>
                      <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="Eduardo Ezequiel">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="" class="texto2">Apellidos</label>
                      <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="López Rivera">
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col">
                      <label for="" class="texto2">Nombre de Usuario</label>
                      <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="username123">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 ">
                      <label for="" class="texto2">Fecha de Nacimiento</label>
                      <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="dd-mm-aaaa">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="" class="texto2">Teléfono</label>
                      <input type="text" class="form-control personalizacionPolus2 m-1" placeholder="0000-0000">
                    </div>  
                  </div>
                </form>

                <!-- Credenciales del Usuario -->
                <form class="mt-3">
                  <p class="texto">Credenciales</p>
                  <div class="row">
                    <div class="col">
                      <label for="" class="texto2">Correo Eletrónico</label>
                      <input type="email" class="form-control personalizacionPolus2 m-1" placeholder="ejemplo@mail.com">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="" class="texto2">Contraseña</label>
                      <input type="password" class="form-control personalizacionPolus2 m-1" placeholder="">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                      <label for="" class="texto2">Confirmar Contraseña</label>
                      <input type="password" class="form-control personalizacionPolus2 m-1" placeholder="">
                    </div>
                  </div>
                  <!-- Boton -->
                  <div class="row">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                      <a href="" class="btn boton2 d-block m-auto my-4">Registrate</a>
                    </div>
                  </div>
                </form>
            </div>
            <!-- Columna 2 -->
            <div class="col-md-6">
                <img src="../../resources/img/loginfondo.png" alt="" class="img-fluid imagenDesaparecer d-block m-auto" width="430">
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>