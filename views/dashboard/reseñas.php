<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Reseñas','index_privado_estilos.css');
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
          <div class="row">
                <div class="col-12 title"><h1>Reseñas</h1></div>
          </div>
           <!-- Espacio para buscar -->
           <div class="row mt-4 justify-content-center animate__animated animate__fadeInUp animate__faster">
                <div class="col-12 d-flex justify-content-center">
                    <form class="d-flex" id="search-form" name="search-form">
                        <input class="form-control me-2" type="search" id="search" name="search" placeholder="Buscar..." aria-label="Search">
                        <button class="btn btn-outline-dark me-2" type="submit">Buscar</button>
                    </form>
                    <button class="btn btn-outline-dark" type="submit">Reiniciar</button>
                </div>
            </div><br><br>

          <div class="row animate__animated animate__fadeInUp animate__faster table-responsive">
                <!-- Columnas de tabla de datos -->
                    <div class="col-12">
                        <table class="table">
                            <thead class="bg-dark tabla">
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Puntuación</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows">
                            <tr>
                                <td>Eduardo Rivera</td>
                                <td>12-2-2021</td>
                                <td>5 estrellas</td>
                                <th scope="row">
                                    <div class="row">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarResenas" class="btn btn-outline-primary"><i
                                                    class="fas fa-info tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

<!-- Modal para administrar reseñas -->
<div class="modal fade" id="administrarResenas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                        class="fas fa-info-circle mx-2"></span>Administrar Reseña</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-2 mt-2">
                <form method="post" id="administrarResena-form">
                    <h5 class="text-center mb-3">Informacion de la Reseña</h5>
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center">
                            <input class="visually-hidden" type="number" name="idResena" id="idResena">

                            <div class="d-flex flex-column mx-4">
                                <label for="#" class="form-label text-center ">Cliente: </label>
                                <label class="labelInformacion text-center mb-3" id="txtCliente" name="txtCliente">aa</label>

                                <label for="#" class="form-label text-center">Fecha: </label>
                                <label class="labelInformacion text-center" id="txtFecha" name="txtFecha">aaa</label>
                            </div>

                            <div class="d-flex flex-column mx-4">
                                <label for="#" class="form-label text-center">Puntuacion: </label>
                                <label class="labelInformacion text-center mb-3" id="txtPuntuacion" name="txtPuntuacion">xxx</label>

                                <label for="#" class="form-label text-center">Factura: </label>
                                <label class="labelInformacion text-center" id="txtIdPedido" name="txtIdPedido">xxxxx</label>
                            </div>
                            
                        </div>
                    </div>

                    <h5 class="text-center my-3">Opciones</h5>

                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="detallePedido" class="form-label">Reseña:</label>
                            <textarea class="form-control textareaMiCuenta" id="detallePedido" readonly></textarea>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-outline-dark float-right" type="submit">Ocultar</button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="#" class="form-label">Respuesta:</label>
                            <textarea class="form-control textareaMiCuenta" id="detallePedido"></textarea>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-outline-dark float-right" type="submit">Responder</button>
                            </div>
                        </div>
                    </div>
                    
                       
                </form>
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