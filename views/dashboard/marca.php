<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('marca_privado_estilos.css', 'Polus - Dashboard');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div id="page-content-wrapper">
        <!-- Contenedor de la barra inicial -->
        <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
        <!-- Inicio del contenido -->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 title"><h1>Marca de productos</h1></div>
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
                <!-- Fila de primeros tres apartados -->
                <div class="row">
                    <!-- Columna de información personal -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Información:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <!-- Formulario del información personal -->
                            <div class="col-12 formulario">
                                <form>
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><br>
                </div><br><br>
                <!-- Fila de opciones -->
                <div class="row">
                    <!-- Columna de opciones -->
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <p class="apartado">Opciones:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <!-- Botones -->
                        <div class="col-12 formulario1">
                            <div class="mb-3">
                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                <button class="btn btn-outline-dark" id="selecciona">Agregar</button>
                                <button class="btn btn-outline-dark" id="selecciona">Suspender</button>
                                <button class="btn btn-outline-dark" id="selecciona1">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <!-- Fila de la tabla -->
                <div class="row">
                    <!-- Columnas de tabla de datos -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Tabla de datos:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    </div>
                    <div class="col-12">
                        <table class="table table-hover">
                            <thead class="bg-dark tabla">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Tipo de usuario</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Katherine Andrea</td>
                                    <td>González Salinas</td>
                                    <td>Femenino</td>
                                    <td>katy06salinas@gmail.com</td>
                                    <td>kath34</td>
                                    <td>Administrador</td>
                                    <td>7173-7109</td>
                                    <td>San Salvador</td>
                                </tr>
                                    <td>Eduardo Ezequiel</td>
                                    <td>López Rivera</td>
                                    <td>Masculino</td>
                                    <td>eduardoxlr@gmail.com</td>
                                    <td>eduardxlr</td>
                                    <td>Empleado</td>
                                    <td>7543-0245</td>
                                    <td>San Salvador</td>
                                </tr>
                                <tr>
                                    <td>Eduardo Antonio</td>
                                    <td>Magaña Hernandez</td>
                                    <td>masculino</td>
                                    <td>magaña@gmail.com</td>
                                    <td>emagaña</td>
                                    <td>Repartidor</td>
                                    <td>8042-1840</td>
                                    <td>San Salvador</td>
                                </tr>
                            </tbody>
                        </table> 
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

