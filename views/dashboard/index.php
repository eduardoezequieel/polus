<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('index_privado_estilos.css', 'Polus - Dashboard');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div id="page-content-wrapper">
      <!-- Contenedor de la barra inicial -->
      <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
       <!-- Section para mostrar contenido -->
      <section>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 title"><h1>Inicio</h1></div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <img src="../../resources/img/dashboard_img/grafica2.png" class="img-fluid imagenGrafica">
              <p class="parrafo tituloUsuarios">Administrar Usuarios</p>
              <p class="parrafo titleDescripcion">Administra a tus usuarios de una manera eficaz para mejorar quienes están en el sistema y
                garantizar la integridad del mismo
              </p>
              <button class="btn btn-outline-dark verMas">Ver más</button>
            </div>
            <div class="col-lg-6">
              <img src="../../resources/img/dashboard_img/grafica1.png" class="img-fluid imagenGrafica">
              <p class="parrafo tituloUsuarios">Gestionar Pedidos</p>
              <p class="parrafo titleDescripcion">Revisa todo el resgistro de pedidos que han hecho tus clientes. Programar, cerrar y/o supender
                son parte importante para tus ganancias.
              </p>
              <button class="btn btn-outline-dark verMas">Ver más</button>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Bootstrap core JavaScript -->
    <?php
    //Se imprime el script para las direcciones de Bootstrap core JavaScript
    dashboard_Page::scriptBTJS();
    ?>

    <!-- Movimiento sidebar -->
    <?php
    //Se imprime el script para el movimiento del sidebar
    dashboard_Page::sidebarTemplateMovement();
    ?>
   </body>
</html>