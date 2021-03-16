<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
public_Page::navbarTemplate('Polus El Salvador','index_publico_styles.css');
?>
<!--Fin del navbar-->
  <body>
  	<link rel="stylesheet" type="text/css" href="../../resources/css/carrito_publico.css">
    <!-- Fondo -->
    <div id="background">
      <!-- Caja -->
      <div id="form" class="paddingLados">
		<!-- Inicio del titulo -->
        <div class="row">
			<div class="col-12 tituloPrincipal">
				<h2 id="tu">Tu  <span id="carro"><b>carrito</b></span></h2>
			</div>
		</div><br>
		<!-- Inicio del tabla de datos -->
		<div class="row">
			<table class="table table-dark table-hover table-responsive-lg tabla1">
                <thead class="bg-dark tabla">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
						<th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
        	            <td>Short deportivo Caballero color negro</td>
                        <td>$10.00</td>
                        <td>1</td>
						<td>
							<a href="producto.php" class="btn btn-outline-light centrarImagen2">Ver</a>
							<a href="pagina_principal.php" class="btn btn-outline-light centrarImagen3">Cancelar</a><br><br>
						</td>
	                </tr>
					<tr>
						<td>Pack de calidad de sombras para tu maquillaje.</td>
                        <td>$15.00</td>
                        <td>3</td>
						<td>
							<a href="producto.php" class="btn btn-outline-light centrarImagen2">Ver</a>
							<a href="pagina_principal.php" class="btn btn-outline-light centrarImagen3">Cancelar</a><br><br>
						</td>
	                </tr>
					<tr>
						<td>Mascarilla hecha de aguacate de Suramérica.</td>
                        <td>$20.00</td>
                        <td>2</td>
						<td>
							<a href="producto.php" class="btn btn-outline-light centrarImagen2">Ver</a>
							<a href="pagina_principal.php" class="btn btn-outline-light centrarImagen3">Cancelar</a><br><br>
						</td>
	                </tr>
                </tbody>
            </table> 
		</div><br>
		<!-- Inicio del sección de pago -->
		<div class="row">
			<div class="col-12 pago">
				<p>Total: $95.00</p>
				<a href="pago.php" class="btn btn-outline-light centrarImagen2">Pagar</a>
			</div>
		</div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>