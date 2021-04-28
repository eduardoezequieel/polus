<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','inventario_privado_estilos.css');
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
                <div class="col-lg-12 title">
                    <h1>Inventario</h1>
                </div>
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
            <!-- Fila de la tabla -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover table-responsive-lg">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Nombre y descripción</th>
                                <th scope="col">Talla</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ropa-Short de hombre color azul con bordado</td>
                                <td>Medium</td>
                                <td>12</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                                <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                                    class="btn btn-outline-danger"><i
                                                        class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <td>Maquillaje-Sombras</td>
                            <td>N/A</td>
                            <td>5</td>
                            <th scope="row">
                                <div class="row justify-c ">
                                    <div class="col-12 d-flex">
                                        <!-- Button trigger modal -->
                                        <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                            class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                                        <h5 class="mx-1">
                                            </h1>

                                            <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                                class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt tamanoBoton"></i></a>
                                    </div>
                                </div>
                            </th>
                            </tr>
                            <tr>
                                <td>Cuidado facial-Mascarillas</td>
                                <td>N/A</td>
                                <td>20</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                                <a href="#" data-toggle="modal" data-target="#administrarInventario"
                                                    class="btn btn-outline-danger"><i
                                                        class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal para Administrar Productos -->
            <div class="modal fade" id="administrarInventario" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollablemodal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Administrar Productos</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn fas fa-times" data-dismiss="modal" aria-label="">

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">

                            <!-- Inicio del contenido-->
                            <!-- Fila de dos apartados(producto,opciones) -->
                            <div class="row">
                                <!-- Columna de formulario para producto-->
                                <div class="col-lg-6">
                                    <p class="apartado">Producto:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <div class="col-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre y descripción:</label>
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button"
                                                            id="dropdownMenuButton1" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Seleccionar...
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Ropa-Short</a></li>
                                                            <li><a class="dropdown-item" href="#">Maquillaje-Sombras</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Cuidado
                                                                    Facial-Mascarillas</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Columna de opciones -->
                                        <div class="col-lg-4 col-sm-12 col-xs-12">
                                            <p class="apartado">Opciones:</p>
                                            <img src="../../resources/img/dashboard_img/separator.png"
                                                class="img-fluid imagenSeparator">
                                            <!-- Botones -->
                                            <div class="col-12 formulario1">
                                                <div class="mb-3">
                                                    <label for="selecciona" class="form-label">Selecciona:</label><br>
                                                    <button class="btn btn-outline-dark"
                                                        id="selecciona">Agregar</button><br><br>
                                                    <button class="btn btn-outline-dark"
                                                        id="selecciona">Actualizar</button><br><br>
                                                    <button class="btn btn-outline-dark"
                                                        id="selecciona">Suspender</button><br><br>
                                                    <button class="btn btn-outline-dark"
                                                        id="selecciona">Activar</button><br><br>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Columna de información -->
                                <div class="col-12"><br><br>
                                    <p class="apartado">Información:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <div class="col-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="talla" class="form-label">Talla:</label>
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button"
                                                            id="dropdownMenuButton1" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Seleccionar...
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">XS</a></li>
                                                            <li><a class="dropdown-item" href="#">S</a></li>
                                                            <li><a class="dropdown-item" href="#">M</a></li>
                                                            <li><a class="dropdown-item" href="#">L</a></li>
                                                            <li><a class="dropdown-item" href="#">XL</a></li>
                                                        </ul>
                                                    </div><br>
                                                    <div class="mb-3">
                                                        <label for="Cantidad" class="form-label ">Cantidad:</label>
                                                        <input type="text" class="form-control" id="Cantidad">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
            <br><br>
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