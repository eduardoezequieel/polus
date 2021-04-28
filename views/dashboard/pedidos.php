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
                <div class="row">
                    <div class="col-lg-12 title"><h1>Pedidos</h1></div>
                </div><br>
                 <!-- Espacio para buscar -->
                <div class="row">
                    <div class="col-lg-8 formulario2">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit">Buscar</button>
                        </form>
                    </div>
                </div><br><br>

                <div class="row mb-3">
                    <div class="col-12">
                        <form>
                            <label for="cbEstadoPedido" class="form-label">Filtrar por estado:</label>
                            <select id="cbEstadoPedido" class="form-select" aria-label="Default select example">
                                <option selected>Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="row table-responsive">
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
                            <tbody>
                                <tr>
                                    <td>123456789</td>
                                    <td>González Salinas</td>
                                    <td>27/4/2020</td>
                                    <td>Activo</td>
                                   
                                    <th scope="row">
                                        <div class="row">
                                            <div class="col-12 d-flex">
                                                <!-- Button trigger modal -->
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#administrarPedidos" class="btn btn-outline-primary"><i
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
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <form>
                                        <label for="detallePedido" class="form-label mt-2">Detalles del Pedido:</label>
                                        <textarea class="form-control textareaMiCuenta" id="detallePedido" readonly></textarea>

                                        <h5 class="text-center my-3">¿Qué desea hacer?</h5>
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-outline-dark my-1">Entregar</button>
                                            <button class="btn btn-outline-dark my-1">Cancelar</button>
                                            <button data-bs-toggle="modal" data-bs-target="#informacionCliente" data-bs-dismiss="modal" class="btn btn-outline-dark my-1">Contactar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                    <form>
                                        <label for="#" class="form-label mt-2">Factura:</label>
                                        <h1 class = "labelInformacion">123456789</h1>

                                        <label for="#" class="form-label mt-2">Cliente:</label>
                                        <h1 class = "labelInformacion">Katherine Andrea</h1>

                                        <label for="#" class="form-label mt-2">Fecha del Pedido:</label>
                                        <h1 class = "labelInformacion">27/4/2021</h1>

                                        <label for="#" class="form-label mt-2">Estado:</label>
                                        <h1 class = "labelInformacion">Activo</h1>

                                        <label for="#" class="form-label mt-2">Precio Total del Pedido:</label>
                                        <h1 class = "labelInformacion">$10.99</h1>

                                        <label for="#" class="form-label mt-2">Dirección:</label>
                                        <h1 class = "labelInformacion">Pasaje Caoba, Las Flores, San Salvador</h1>
                                    </form>
                                </div>
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
                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                                    <form>
                                        <label for="#" class="form-label mt-2">Nombres:</label>
                                        <h1 class = "labelInformacion">Katherine Andrea</h1>

                                        <label for="#" class="form-label mt-2">Apellidos:</label>
                                        <h1 class = "labelInformacion">Gonzalez Salinas</h1>

                                        <label for="#" class="form-label mt-2">Fecha de Nacimiento:</label>
                                        <h1 class = "labelInformacion">12/12/2002</h1>

                                        <label for="#" class="form-label mt-2">Teléfono:</label>
                                        <h1 class = "labelInformacion">0000-0000</h1>

                                        <label for="#" class="form-label mt-2">Género:</label>
                                        <h1 class = "labelInformacion">Femenino</h1>
                                    </form>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                                    <div class="divFotografia2 mt-4 mb-4"></div>
                                    <form>
                                        <label for="#" class="form-label mt-2">Correo Electrónico:</label>
                                        <h1 class = "labelInformacion">kathsalinas@gmail.com</h1>

                                        <label for="#" class="form-label mt-2">Usuario:</label>
                                        <h1 class = "labelInformacion">kathsalinas</h1>

                                        <label for="#" class="form-label mt-2">Dirección:</label>
                                        <h1 class = "labelInformacion">Pasaje Caoba, Las Flores, San Salvador</h1>
                                    </form>
                                </div>

                                <div class="row justify-content-end mt-3">
                                    <div class="col-12 justify-content-end align-items-right d-flex">
                                        <button data-bs-toggle="modal" data-bs-target="#administrarPedidos" data-bs-dismiss="modal" class="btn btn-outline-dark">Regresar</button>
                                    </div>
                                </div>
                            </div>
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
    dashboard_Page::sidebarTemplateMovement();
    ?>
   </body>
</html>

