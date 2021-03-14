<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('productos_privado_estilos.css', 'Polus - Dashboard');
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
            <!-- Mostrar titulo -->
            <div class="row">
                <div class="col-12 title"><h1>Administrar productos</h1></div>
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
            <!-- Inicio del contenido-->
            <div class="row">
                <!-- Columna de la información del producto-->
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <p class="apartado">Información del producto:</p>
                    <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator">
                    <div class="row">
                        <!-- Columna 1 de la información del producto-->
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                            <form>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div><br>
                                <div class="mb-3 foto">
                                    <img src="../../resources/img/dashboard_img/imagen.png" class="img-fluid imagenUsuario1">
                                    <button class="btn btn-outline-dark" id="agregarFoto">Agregar foto</button>
                                </div><br>
                                <div class="mb-3">
                                    <label class="form-label">Género:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Dama</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Caballero</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                         <!-- Columna 2 de la información del producto-->
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                            <div class="mb-3">
                                <label for="Descripciónn" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="Descripción"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Tipo de productos" class="form-label">Tipo de productos:</label>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                                        Tipos de productos
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Ropa-Short</a></li>
                                        <li><a class="dropdown-item" href="#">Maquillaje-Sombras</a></li>
                                        <li><a class="dropdown-item" href="#">Cuidado Facial-Mascarillas</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input type="text" class="form-control" placeholder="0.00">
                                </div>
                                <div class="row">
                                    <!-- Columna de opciones -->
                                    <div class="col-12">
                                        <p class="apartado1">Opciones:</p>
                                        <img src="../../resources/img/dashboard_img/separator.png" class="img-fluid imagenSeparator1">
                                        <!-- Botones -->
                                        <div class="col-12 formulario1">
                                            <div class="mb-3">
                                                <label for="selecciona" class="form-label">Selecciona:</label><br>
                                                <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
                                                <button class="btn btn-outline-dark" id="selecciona">Supender</button><br><br>
                                                <button class="btn btn-outline-dark" id="selecciona1">Activar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <th scope="col">Nombre</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Género</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Tipo de producto</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Short deportiva</td>
                                <td>url</td>
                                <td>Caballero</td>
                                <td>Short  deportiva color negro.</td>
                                <td>Ropa-Short</td>
                                <td>$10.00</td>
                            </tr>
                                <td>Pack de sombras Luna</td>
                                <td>url</td>
                                <td>Dama</td>
                                <td>Pack de calidad de sombras para tu maquillaje.</td>
                                <td>Maquillaje-Sombras</td>
                                <td>$25.00</td>
                            </tr>
                            <tr>
                                <td>Mascarilla de aguacate</td>
                                <td>url</td>
                                <td>Dama</td>
                                <td>Mascarilla hecha de aguacate de Surámerica.</td>
                                <td>Cuidado facial-Mascarilla</td>
                                <td>$15.00</td>
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