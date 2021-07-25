<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','index_privado_estilos.css');
?>
<!--Fin del sidebar-->
<!-- Contenido de la Pagina -->
<div class="page-content p-5" id="content">
	<?php

      //Se imprime el script para las direcciones de Bootstrap core JavaScript
      dashboard_Page::barraInicial();
      ?>
	<div class="container-fluid">
		<!-- Mostrar titulo -->
		<?php
            dashboard_Page::mensajeBienvenida();
          ?>
		<!-- Mostrar opciones -->
		<div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
				<div class="form-group" id="priceHistorydiv">
					<form method="post" id="priceHistory-form">
						<input class="d-none" type="text" id="id_producto" name="id_producto" value="1">
						<button id="btnPriceHistory" class="d-none" type="submit">Enviar</button>
					</form>
					<h4 class="text-center lead">Historial de Precios por Producto</h4>
					<canvas id="historialPrecio" width="100" height="100"></canvas>
					<div class="d-flex flex-column justify-content-center align-items-center">
						<button id="btnHistorialPrecio" data-bs-toggle="modal" data-bs-target="#seleccionarProductoPrecio" class="btn btn-outline-dark btn-sm" data-toggle="#seleccionarProductoPrecio">Seleccionar...</button>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
				<div class="form-group">
					<h4 class="text-center lead">Productos Mejores Puntuados</h4>
					<canvas id="mejorPuntuados" width="100" height="100"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal para seleccionar un producto para la grafica -->
<div class="modal fade" id="seleccionarProductoPrecio" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content justify-content-center px-3 py-2">
				<!-- Cabecera del Modal -->
				<div class="modal-header">
					<!-- Titulo -->
					<h5 class="modal-title tituloModal" id="exampleModalLabel"><span
							class="fas fa-info-circle mx-2"></span>Seleccionar Producto</h5>
					<!-- Boton para Cerrar -->
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<br>
				<!-- Contenido del Modal -->
				<div class="textoModal px-3 pb-4 mt-2">
					<div class="row">
						<div class="col-12 d-flex flex-column">
							<form class="d-flex mb-3" id='search-historialPrecio' name='search-historialPrecio'>
								<input class="form-control me-2 w-50" type="search" placeholder="Buscar... {Nombre del Producto}" aria-label="Search" id='searchOnDashboard' name='searchOnDashboard'>
								<button class="btn btn-outline-dark  me-2" type="submit">Buscar</button>
								<button class="btn btn-outline-dark" id="btnReiniciarProductos">Reiniciar</button>
							</form>
						</div>
					</div>
					<div class="row table-responsive">
						<!-- Columnas de tabla de datos -->
						<div class="col-12">
							<table class="table">
								<thead class="bg-dark tabla">
									<tr>
										<th scope="col">Producto</th>
										<th scope="col">Marca</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody id='tbody-historialPrecio'>
								</tbody>
							</table>
						</div>
					</div>
				<!-- Fin del Contenido del Modal -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fin del Modal -->
<!-- Bootstrap core JavaScript -->
<?php
    //Se imprime el script para las direcciones de Bootstrap core JavaScript
    dashboard_Page::scriptBTJS();
    ?>

<!-- Movimiento sidebar -->
<?php
    //Se imprime el script para el movimiento del sidebar
    dashboard_Page::sidebarTemplateMovement('pagina_dashboard.js');
    ?>
</body>

</html>