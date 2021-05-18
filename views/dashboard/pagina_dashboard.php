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
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <img src="../../resources/img/dashboard_img/grafica2.png" class="img-fluid imagenGrafica">
              <p class="parrafo tituloUsuarios">Administrar Usuarios</p>
              <p class="parrafo titleDescripcion">Administra a tus usuarios de una manera eficaz para mejorar quienes están en el sistema y
                garantizar la integridad del mismo.
              </p>
              <a href="../../views/dashboard/administrar_usuarios.php">
                <button class="btn btn-outline-dark verMas">Ver más</button>
              </a>
            </div><br>
            <div class="col-lg-5">
              <img src="../../resources/img/dashboard_img/grafica1.png" class="img-fluid imagenGrafica">
              <p class="parrafo tituloUsuarios">Gestionar Pedidos</p>
              <p class="parrafo titleDescripcion">Revisa todo el resgistro de pedidos que han hecho tus clientes. Entregar, cancelar y/o finalizar
                tus pedidos son parte importante para tus ganancias.
              </p>
              <a href="../../views/dashboard/pedidos.php">
                <button class="btn btn-outline-dark verMas">Ver más</button>
              </a>
            </div>
          </div>
        </div>
    </div>
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