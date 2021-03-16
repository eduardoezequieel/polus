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
    <link rel="stylesheet" type="text/css" href="../../resources/css/reseña_publico_estilos.css">
    <title>Polus - Iniciar Sesión</title>
  </head>
  <body>
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados">
        <div class="row">
            <!-- Inicio de reseña -->
            <div col="col-12">
                <h1 class="titulos4" id="parrafo">
                    Escribe tu reseña
                </h1>
            </div>
            <!-- Inicio de puntuación -->
            <div class="form col-12">
                <textarea cols="30" rows="5" class="form-control personalizacionPolus" placeholder="Escribe aquí..."></textarea>
                <br>
                <h2 class="titulos5" id="parrafo">
                    Valora tu experiencia con nosotros
                </h2>
                <div class="col-lg-12 valoracion">
                     <input id="radio1" type="radio" name="estrellas" value="1">
                      <label for="radio1">★</label>
                      <input id="radio2" type="radio" name="estrellas" value="2">
                      <label for="radio2">★</label>
                      <input id="radio3" type="radio" name="estrellas" value="3">
                      <label for="radio3">★</label>
                      <input id="radio4" type="radio" name="estrellas" value="4">
                      <label for="radio4">★</label>
                      <input id="radio5" type="radio" name="estrellas" value="5">
                      <label for="radio5">★</label>
                </div>
                <!-- Inicio de botón -->
                <div class="col-12 boton3">
                    <button class="btn btn-outline-light centrarImagenes2">Enviar Reseña</button><br><br>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>