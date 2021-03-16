<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','imagenes_privado_estilos.css');
?>
    <!--Fin del sidebar-->
    <!-- Contenido de la Pagina -->
    <div class="page-content p-5" id="content">
      <!-- Contenedor de la barra inicial -->
      <?php
        //Se imprime la plantilla la barra inicial
        dashboard_Page::barraInicial();
        ?>
       <!-- Section para mostrar contenido -->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 title"><h1>Imágenes de productos</h1></div>
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
                <!-- Fila de dos apartados(producto,opciones) -->
                <div class="row">
                    <!-- Columna de formulario para producto-->
                    <div class="col-lg-6">
                        <p class="apartado">Producto:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <div class="col-12 formulario">
                                <form>
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre y descripción:</label>
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                                Seleccionar una opción
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Ropa-Short</a></li>
                                                <li><a class="dropdown-item" href="#">Maquillaje-Sombras</a></li>
                                                <li><a class="dropdown-item" href="#">Cuidado Facial-Mascarillas</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    <!-- Columna de información -->
                    <div class="col-12"><br><br>
                        <p class="apartado">Imágenes:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <div class="row">
                            <div class="col-12 formulario">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                                            <img src="../../resources/img/dashboard_img/imagen.png" class="img-fluid imagen1">
                                            <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                        </div>
                                        <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                                            <img src="../../resources/img/dashboard_img/imagen.png" class="img-fluid imagen1">
                                            <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                        </div>
                                        <div class="col-lg-4 col-sm-4 col-xs-12 mb-3">
                                            <img src="../../resources/img/dashboard_img/imagen.png" class="img-fluid imagen1">
                                            <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    <!-- Columna de opciones -->
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <p class="apartado">Opciones:</p>
                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                        <!-- Botones -->
                        <div class="col-12 formulario1">
                            <div class="mb-3">
                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                <button class="btn btn-outline-dark" id="selecciona">Agregar</button>
                                <button class="btn btn-outline-dark" id="selecciona">Actualizar</button><br><br>
                                <button class="btn btn-outline-dark" id="selecciona">Suspender</button>
                                <button class="btn btn-outline-dark" id="selecciona">Activar</button>
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
                        <table class="table table-hover table-responsive-lg">
                            <thead class="bg-dark tabla">
                                <tr>
                                    <th scope="col">Nombre y descripción</th>
                                    <th scope="col">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ropa-Short</td>
                                    <td>url</td>

                                </tr>
                                    <td>Maquillaje-Sombras</td>
                                    <td>url</td>
                                </tr>
                                <tr>
                                    <td>Cuidado facial-Mascarillas</td>
                                    <td>url</td>
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