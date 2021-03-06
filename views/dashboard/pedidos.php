<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','pedidos_privado_estilos.css');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div class="page-content p-5" id="content">
        <!-- Contenedor de la barra inicial -->
        <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
        <!-- Inicio del contenido -->
        <section>
            <div class="container-fluid">
                <div class="row animate__animated animate__fadeInUp animate__faster">
                    <div class="col-lg-12 title"><h1>Pedidos</h1></div>
                </div><br>
                 <!-- Espacio para buscar -->
                <div class="row animate__animated animate__fadeInUp animate__faster">
                    <div class="col-lg-8 formulario2">
                        <form class="d-flex" id="search-form">
                            <input class="form-control me-2" type="search" placeholder="Buscar... {Cliente}" aria-label="Search" id="search" name="search">
                            <button class="btn btn-outline-dark me-3" type="submit">Buscar</button>
                            <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                        </form>
                    </div>
                </div><br><br>

                <div class="row mb-3 animate__animated animate__fadeInUp animate__faster" id="filtro">
                    <div class="col-12">
                        <label for="cbEstadoPedido" class="form-label">Filtrar por estado:</label>
                        <form class="d-flex" id="search-form-estado" name="search-form-estado">
                            <select id="cbEstadoPedidoSearch" name = "cbEstadoPedidoSearch" class="form-select me-2 w-25" aria-label="Default select example">
                                
                            </select>
                            <button class="btn btn-outline-dark me-2" id="btnFiltrar">Filtrar</button>
                           <button class="btn btn-outline-dark" id="btnReiniciar1">Reiniciar</button>
                        </form>
                        
                    </div>
                </div>

                <a class="btn btn-outline-dark opciones" href="../../app/reports/dashboard/pedidos_estados.php" target="_blank" data-tooltip="Reporte de productos por categoría">
                    <i class="fas fa-book mx-2"></i> Generar reporte</a><br><br>

                <div class="row animate__animated animate__fadeInUp animate__faster table-responsive">
                <!-- Columnas de tabla de datos -->
                    <div class="col-12">
                        <table class="table">
                            <thead class="bg-dark tabla">
                                <tr>
                                    <th scope="col">Factura</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Fecha del Pedido</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody-rows">

                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </section>
        
        <!-- Modal para administrar pedidos -->
        <div class="modal fade" id="administrarPedidos" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Administrar Pedido</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="informacionPedido-form">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="detallePedido" class="form-label mt-2">Detalles del Pedido:</label>
                                    <textarea class="form-control textareaMiCuenta" id="detallePedido" readonly></textarea>

                                    <h5 class="text-center my-3">¿Qué desea hacer?</h5>
                                    <div class="d-flex flex-column">
                                        <button class="btn btn-outline-dark my-1" type="submit" id="btnEntregar">Entregar</button>
                                        <button class="btn btn-outline-dark my-1" type="submit" id="btnCancelar">Cancelar</button>
                                        <button class="btn btn-outline-dark my-1" type="submit" id="btnActivar">Activar</button>
                                        <button data-bs-toggle="modal" id="btnContactar" data-bs-target="#informacionCliente" data-bs-dismiss="modal" class="btn btn-outline-dark my-1">Contactar</button>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column">
                                    <input class="visually-hidden" type="number" name="idPedido" id="idPedido">
                                    <label for="#" class="form-label mt-2">Factura:</label>
                                    <label class = "labelInformacion" id="txtPedido" name="txtPedido"></label>

                                    <label for="#" class="form-label mt-2">Cliente:</label>
                                    <label class = "labelInformacion" id="txtCliente" name="txtCliente"></label>

                                    <label for="#" class="form-label mt-2">Fecha del Pedido:</label>
                                    <label class = "labelInformacion" id="txtFechaPedido" name="txtFechaPedido"></label>

                                    <label for="#" class="form-label mt-2">Estado:</label>
                                    <label class = "labelInformacion" id="txtEstadoPedido" name="txtEstadoPedido"></label>

                                    <label for="#" class="form-label mt-2">Precio Total del Pedido:</label>
                                    <label class = "labelInformacion" id="txtPrecioTotal" name="txtPrecioTotal"></label>

                                    <label for="#" class="form-label mt-2">Dirección:</label>
                                    <label class = "labelInformacion" id="txtDireccion" name="txtDireccion"></label>
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

        <!-- Modal para ver información del cliente -->
        <div class="modal fade" id="informacionCliente" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Información del Cliente</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="informacionCliente-form">
                                <div class="row justify-content-center">
                                    <input class="visually-hidden" type="number" name="idCliente" id="idCliente">
                                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                                        <label for="#" class="form-label mt-2">Nombres:</label>
                                        <label class="labelInformacion" id="txtNombre"></label>

                                        <label for="#" class="form-label mt-2">Apellidos:</label>
                                        <label class="labelInformacion" id="txtApellido"></label>

                                        <label for="#" class="form-label mt-2">Fecha de Nacimiento:</label>
                                        <label class = "labelInformacion" id="txtFechaNacimiento"></label>

                                        <label for="#" class="form-label mt-2">Teléfono:</label>
                                        <label class = "labelInformacion" id="txtTelefono"></label>

                                        <label for="#" class="form-label mt-2">Género:</label>
                                        <label class = "labelInformacion" id="txtGenero"></label>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="bordeDivFotografia">
                                                <div class="divFotografia" id="divFoto" name="divFoto">

                                                </div>
                                            </div>
                                        </div>
        
                                        <label for="#" class="form-label mt-2">Correo Electrónico:</label>
                                        <label class = "labelInformacion" id="txtCorreo"></label>

                                        <label for="#" class="form-label mt-2">Usuario:</label>
                                        <label class = "labelInformacion" id="txtUsuario"></label>

                                        <label for="#" class="form-label mt-2">Dirección:</label>
                                        <label class = "labelInformacion" id="txtDireccion2"></label>
                                    </div>

                                    <div class="row justify-content-end mt-3">
                                        <div class="col-12 justify-content-end align-items-right d-flex">
                                            <button data-bs-toggle="modal" data-bs-target="#administrarPedidos" data-bs-dismiss="modal" class="btn btn-outline-dark">Regresar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->
    </div>
    <!-- Bootstrap core JavaScript -->
    <?php
    //Se imprime el script para las direcciones de Bootstrap core JavaScript
    dashboard_Page::scriptBTJS();
    ?>

    <!-- Movimiento sidebar -->
    <?php
    //Se imprime el script para el movimiento del sidebar
    dashboard_Page::sidebarTemplateMovement('pedidos.js');
    ?>
   </body>
</html>

