<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard');
?>
      <!-- Contenido de la Pagina -->
      <div id="page-content-wrapper">
        <button class="btn" id="menu-toggle"><i class="fas fa-bars lead p-2 text-black"></i></button>
  
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="../../app/jquery/jquery.min.js"></script>
    <script src="../../app/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Iconos en Movimiento -->
    
    <script>
      $('.usuarios-btn').click(function(){
        $('nav ul .usuarios-mostrar').toggleClass("mostrar");
        $('nav ul .primero').toggleClass("rotate");
      });
      $('.productos-btn').click(function(){
        $('nav ul .productos-mostrar').toggleClass("mostrar1");
        $('nav ul .segundo').toggleClass("rotate");
      });
    </script>

      <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
   </body>
</html>