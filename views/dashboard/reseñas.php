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
           <div class="row mt-4 justify-content-center animate__animated animate__fadeInUp animate__faster mb-4">
                <div class="col-12 d-flex justify-content-center">
                    <form method="post" class="d-flex" id="search-form" name="search-form">
                        <input class="form-control me-2" type="search" id="search" name="search" placeholder="Buscar... {Apellido, Nombre, Puntuación}" aria-label="Search">
                        <button class="btn btn-outline-dark me-2">Buscar</button>
                    </form>
                    <button class="btn btn-outline-dark" type="submit" id="btnReiniciar">Reiniciar</button>
                </div>
            </div>

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
            <div class="textoModal px-3 pb-3 mt-2">
                <form method="post" id="administrarResena-form">
                   
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center">
                            <input class="visually-hidden" type="number" name="idReseña" id="idReseña">

                            <div class="d-flex flex-column mx-4">
                                <label for="#" class="form-label">Cliente: </label>
                                <label class="labelInformacion mb-3" id="txtCliente" name="txtCliente">aa</label>

                                <label for="#" class="form-label">Fecha: </label>
                                <label class="labelInformacion" id="txtFecha" name="txtFecha">aaa</label>
                            </div>

                            <div class="d-flex flex-column mx-4">
                                <label for="#" class="form-label">Puntuación: </label>
                                <label class="labelInformacion mb-3" id="txtPuntuacion" name="txtPuntuacion">xxx</label>

                                <label for="#" class="form-label">Factura: </label>
                                <label class="labelInformacion" id="txtIdPedido" name="txtIdPedido">xxxxx</label>
                            </div>
                            
                        </div>
                    </div>

                    <h5 class="text-center my-3">Opciones</h5>

                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="detallePedido" class="form-label">Comentario:</label>
                            <textarea class="form-control textareaMiCuenta" id="txtReseña" readonly></textarea>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-outline-dark float-right" type="submit" id="btnEliminar" name="btnEliminar">Eliminar</button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="#" class="form-label">Respuesta:</label>
                            <textarea class="form-control textareaMiCuenta" id="txtRespuesta" name="txtRespuesta"></textarea>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-outline-dark float-right" type="submit" id="btnResponder" name="btnResponder">Responder</button>
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
    dashboard_Page::sidebarTemplateMovement('reseñas.js');
    ?>