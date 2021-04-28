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
                        <button class="btn btn-dark" type="submit">Buscar</button>
                    </form>
                </div>
                <div class="col-12 ">
                    <br><br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarInventario" class="btn btn-outline-dark opciones">
                        <i class="fas fa-plus"></i> Agregar inventario
                    </a> 
                    <a href="tipos_producto.php" class="btn btn-outline-dark  opciones"><i class="fas fa-tshirt"></i> Tipos de
                        productos
                    </a>
                    <a href="marca.php" class="btn btn-outline-dark  opciones"><i class="fas fa-tag"></i> Marcas</a>
                </div>
            </div>
            <!-- Fila de la tabla -->
            <div class="row table-responsive-lg">
                <div class="col-12">
                    <table class="table table-hover ">
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
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarInventario"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                            <a href="#" data--bs-toggle="modal"
                                                data-bs-target="#administrarInventario"
                                                class="btn btn-outline-danger"><i
                                                class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>Ropa-Short de hombre color azul con bordado</td>
                                <td>Medium</td>
                                <td>12</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarInventario"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                            <a href="#" data--bs-toggle="modal"
                                                data-bs-target="#administrarInventario"
                                                class="btn btn-outline-danger"><i
                                                class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>Ropa-Short de hombre color azul con bordado</td>
                                <td>Medium</td>
                                <td>12</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarInventario"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                            <a href="#" data--bs-toggle="modal"
                                                data-bs-target="#administrarInventario"
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
            <!-- Modal para admiministrar Inventario -->
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <!-- Inicio del contenido-->
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
                                                    <label for="cbProducto" class="form-label">Nombre y descripción:</label>
                                                    <select id="cbProducto" class="form-select" aria-label="Default select example">
                                                        <option selected>Seleccionar...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- Columna de información -->
                                <div class="col-6">
                                    <p class="apartado">Información:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <form class="formulario">
                                        <div class="mb-3">
                                            <label for="cbTalla" class="form-label">Talla:</label>
                                            <select id="cbTalla" class="form-select" aria-label="Default select example">
                                                <option selected>Seleccionar...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select><br>
                                            <div class="mb-3">
                                                <label for="Cantidad" class="form-label ">Cantidad:</label>
                                                <input type="text" class="form-control" id="Cantidad">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Columna de opciones -->
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <p class="apartado">Opciones:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <!-- Botones -->
                                    <div class="col-12 formulario">
                                        <div class="mb-3">
                                            <label for="selecciona" id="selecciona" class="form-label">Selecciona:</label><br>
                                            <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
                                            <button class="btn btn-outline-dark" id="selecciona">Suspender</button>
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

            <!-- Modal para agregar Inventario -->
            <div class="modal fade" id="agregarInventario" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollablemodal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>agregar Productos</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <!-- Inicio del contenido-->
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
                                                    <label for="cbProducto" class="form-label">Nombre y descripción:</label>
                                                    <select id="cbProducto" class="form-select" aria-label="Default select example">
                                                        <option selected>Seleccionar...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- Columna de información -->
                                <div class="col-6">
                                    <p class="apartado">Información:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <form class="formulario">
                                        <div class="mb-3">
                                            <label for="cbTalla" class="form-label">Talla:</label>
                                            <select id="cbTalla" class="form-select" aria-label="Default select example">
                                                <option selected>Seleccionar...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select><br>
                                            <div class="mb-3">
                                                <label for="Cantidad" class="form-label ">Cantidad:</label>
                                                <input type="text" class="form-control" id="Cantidad">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Columna de opciones -->
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <p class="apartado">Opciones:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <!-- Botones -->
                                    <div class="col-12 formulario">
                                        <div class="mb-3">
                                            <label for="selecciona" id="selecciona" class="form-label">Selecciona:</label><br>
                                            <button class="btn btn-outline-dark" id="selecciona">Agregar</button>
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