<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','index_publico_styles.css');
?>
<!--Fin del navbar-->
  <body>
  	<link rel="stylesheet" type="text/css" href="../../resources/css/pago_publico.css">
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados">
        <!-- Inicio del titulo -->
        <div class="row">
			    <div class="col-12 tituloPrincipal">
				    <h2 id="titulos">Pago</h2>
			    </div>
          <!-- Inicio de dirección  -->
          <div class="col-12">
            <br><p>¿Adónde se dirige el pedido?</p>
            <textarea cols="50" rows="2" class="form-control  personalizacionPolus" placeholder="Dirección en la base de datos"></textarea>
          </div>
          <!-- Inicio de información de contacto -->
          <div class="col-12">
            <br><br>
            <p>Información de contácto:</p>
            <textarea cols="50" rows="2" class="form-control  personalizacionPolus" placeholder="Información del contacto en la base de datos"></textarea>
          </div>
          <div class="col-12 pago">
            <a href="">
              <button class="btn btn-outline-light centrarImagen4">Confirmar compra</button>
            </a>
          </div>
        </div>
	  	</div>    
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    <!-- IONICONS -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

  </body>
</html>