<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','productos_privado_estilos.css');
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
            <div class="row">
                <div class="col-lg-12 title"><h1>Tipos de productos</h1></div>
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
            <div class="row">
                <!-- Columna de información -->
                <div class="col-lg-12">
                    <p class="apartado">Información:</p>
                    <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    <div class="row formulario4">
                        <div class="col-lg-3 mb-3">
                            <label for="Tipo de usuario" class="form-label">Categoría:</label>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                    Seleccionar categoría
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Ropa</a></li>
                                    <li><a class="dropdown-item" href="#">Maquillaje</a></li>
                                    <li><a class="dropdown-item" href="#">Cuidado facial</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="sub" class="form-label">Subcategoría:</label>
                            <input type="text" class="form-control" id="sub">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Género:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">Femenino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Masculino</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="row">
                <!-- Columna de opciones -->
                <div class="col-lg-12">
                    <p class="apartado">Opciones:</p>
                    <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    <!-- Botones -->
                    <div class="col-12 formulario4">
                        <div class="mb-3">
                            <label for="selecciona" class="form-label">Selecciona:</label><br>
                            <button class="btn btn-outline-dark" id="selecciona">Agregar</button>
                            <button class="btn btn-outline-dark" id="selecciona">Suspender</button>
                            <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
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
                                <th scope="col">Categoría</th>
                                <th scope="col">Subcategoría</th>
                                <th scope="col">Género</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ropa</td>
                                <td>Short</td>
                                <td>Cabellero</td>

                            </tr>
                                <td>Maquillaje</td>
                                <td>Sombras</td>
                                <td>Dama</td>
                            </tr>
                            <tr>
                                <td>Cuidado facial</td>
                                <td>Mascarillas</td>
                                <td>Dama</td>
                            </tr>
                        </tbody>
                    </table> 
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