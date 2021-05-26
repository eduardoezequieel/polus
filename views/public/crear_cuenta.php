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
  <title>Polus - Crear Cuenta</title>
</head>

<body>
  <!-- Fondo -->
  <div id="background">
    <!-- Caja -->
    <div id="form" class="paddingLados animate__animated animate__fadeInUp animate__faster">
      <div class="row">
        <div class="col-12">
          <h1 class="titulo2 text-center m-4">Registro</h1>
        </div>
      </div>
      <form>
        <div class="justify-content-center row animate__animated animate__fadeInUp animate__faster">
          <!-- Columna 1 -->
          <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center paddingLados">
            <div class="form-group mb-2">
              <label for="txtNombre" class="mb-2 texto">Nombres:</label>
              <input type="text" class="form-control personalizacionPolus personalizacionPolusP" id="txtNombre"
              name="txtNombre" placeholder="Juan Armando" >
            </div>
            <div class="form-group mb-2">
              <label for="txtEmail" class="mb-2 texto">Correo:</label>
              <input type="email" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtEmail"
              name="txtEmail" placeholder="ejemplo@mail.com">
            </div>
            <div class="form-group mb-2">
              <label for="txtUsuario" class="mb-2 texto">Usuario</label>
              <input type="text" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtUsuario"
              name="txtUsuario"placeholder="usuario123">
            </div>

            <div class="form-group mb-2">
              <label for="txtContraseña" class="mb-2 texto">Contraseña:</label>
              <input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1"
                id="txtContraseña" name="txtContraseña" placeholder="Contraseña">
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center paddingLados animate__animated animate__fadeInUp animate__faster">
            <div class="form-group mb-2">
              <label for="txtApellidos" class="mb-2 texto">Apellidos:</label>
              <input type="text" class="form-control personalizacionPolus personalizacionPolusP" id="txtApellidos"
              name="txtApellidos"aria-describedby="emailHelp" placeholder="Hernández Perez">
            </div>
            <div class="form-group mb-2">
              <label for="txtEmail" class="mb-2 texto">Confirmar Correo:</label>
              <input type="email" class="form-control personalizacionPolus personalizacionPolusP mb-1"
                id="txtConfirmarEmail" name="txtConfirmarEmail" placeholder="ejemplo@mail.com">
            </div>
            <div class="form-group mb-2">
              <label for="txtFechaNacimiento" class="mb-2 texto">Fecha de Nacimiento:</label>
              <input type="date" class="form-control personalizacionPolus personalizacionPolusP mb-1"
                id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="dd/mm/aaaa" >
            </div>
            <div class="form-group mb-2">
              <label for="txtConfirmarContraseña" class="mb-2 texto">Confirmar Contraseña:</label>
              <input type="password" class="form-control personalizacionPolus personalizacionPolusP mb-1"
                id="txtConfirmarContraseña" name="txtConfirmarContraseña" placeholder="Confirmar Contraseña" >
            </div>
            <div class="row justify-content-center">
              <div class="col-12 d-flex justify-content-center align-items-center">

              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center animate__animated animate__fadeInUp animate__faster">
            <div class="form-group mb-2">
              <label for="txtTelefono" class="mb-2 texto">Teléfono:</label>
              <input type="text" class="form-control personalizacionPolus personalizacionPolusP mb-1" id="txtTelefono"
              name="txtTelefono" placeholder="0000-0000" >
            </div>

            <div class="form-group mb-2">
              <label for="txtDireccion" class="mb-2 texto">Dirección:</label>
              <textarea class="form-control personalizacionPolus personalizacionPolusP mb-1" rows=4
                id="txtDireccion" name="txtDireccion"></textarea>
            </div>

            <div class="mb-3">
              <label for="txtGenero" class="mb-2 texto">Género:</label>
              <select id="txtGenero" name="txtGenero" class="form-select personalizacionPolus personalizacionPolusP" aria-label="Default select example">
                <option selected>Seleccionar...</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
              </select>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center paddingLados animate__animated animate__fadeInUp animate__faster">
            <div class="d-flex flex-column justify-content-center align-items-center">
              <div class="bordeDivFotografia">
                <div class="divFotografia" id="divFoto">
                
                </div>
              </div>
              <div id="btnAgregarFoto">
                <button class="btn btn-outline-light my-2" id="botonFoto"><span class="fas fa-plus"></span></button>
              </div>
              <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
            </div>

          </div>
        </div>

        <div class="row justify-content-center animate__animated animate__fadeInUp animate__faster my-2">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <button type="submit" class="btn boton my-2">Registrarse</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/43634cb7dc.js" crossorigin="anonymous"></script>

</body>

</html>