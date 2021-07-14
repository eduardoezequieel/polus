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
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-lg-12 title">
                    <h1>Inventario</h1>
                </div>
            </div><br>
            <!-- Espacio para buscar -->
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-lg-8 formulario2">
                    <form class="d-flex" id="search-form">
                        <input class="form-control me-2" type="search" placeholder="Buscar... {Nombre}"
                            aria-label="Search" id="search" name="search">
                        <button class="btn btn-outline-dark me-2" type="submit">Buscar</button>
                        <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                    </form>
                </div>
                <div class="col-12 ">
                    <br><br>
                    <a href="#" onclick="openCreateDialog()" data-bs-toggle="modal"
                        class="btn btn-outline-dark opciones">
                        <i class="fas fa-plus mx-2"></i> Agregar inventario
                    </a>
                    <a href="categoria.php" class="btn btn-outline-dark  opciones"><i
                            class="fas fa-bookmark mx-2"></i>Categorías</a>
                    <a href="subcategoria.php" class="btn btn-outline-dark  opciones"><i
                            class="fas fa-tshirt mx-2"></i>Subcategorias</a>
                    <a href="marca.php" class="btn btn-outline-dark  opciones"><i class="fas fa-tag mx-2"></i>
                        Marcas</a>
                </div>
            </div>
            <!-- Fila de la tabla -->
            <div class="row animate__animated animate__fadeInUp animate__faster table-responsive-lg">
                <div class="col-12">
                    <table class="table table-hover ">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Nombre del producto</th>
                                <th scope="col">Talla</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal para admiministrar Inventario -->
            <div class="modal fade" id="inventario" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <form method="post" id="inventario-form">

                                <!-- Inicio del contenido-->
                                <div class="row">
                                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                                    <input class="visually-hidden" type="number" id="idInventario" name="idInventario">
                                    <!-- Columna de formulario para producto-->
                                    <div class="col-lg-6">
                                        <p class="apartado">Producto:</p>
                                        <img src="../../resources/img/dashboard_img/separator.png"
                                            class="img-fluid imagenSeparator">
                                        <div class="row">
                                            <div class="col-12 formulario">
                                                <div class="mb-3">
                                                    <label for="cbProducto" class="form-label">Nombre producto:</label>
                                                    <select id="cbProducto" name="cbProducto" class="form-select"
                                                        aria-label="Default select example">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Columna de información -->
                                    <div class="col-6">
                                        <p class="apartado">Información:</p>
                                        <img src="../../resources/img/dashboard_img/separator.png"
                                            class="img-fluid imagenSeparator">
                                        <div class="mb-3 formulario">
                                            <label for="cbTalla" class="form-label">Talla:</label>
                                            <select id="cbTalla" name="cbTalla" class="form-select"
                                                aria-label="Default select example">
                                            </select><br>
                                            <div class="mb-3">
                                                <label for="Cantidad" class="form-label ">Cantidad:</label>
                                                <input type="text" class="form-control" id="Cantidad" name="Cantidad"
                                                    Required>
                                            </div>
                                        </div>
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
                                                <label for="selecciona" id="selecciona"
                                                    class="form-label">Selecciona:</label><br>
                                                <button type="submit" class="btn btn-outline-dark"
                                                    id="selecciona">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
            <br><br>
            <!-- Modal para sumar cantidad -->
            <div class="modal fade" id="sumarCantidad" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mx-2"></span>Stock del Producto</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="sumarCantidad-form">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="d-none" type="number" id="idProductoInventario" name="idProductoInventario">
                                        <h5 class="text-center">Nombre: <span class="lead" id="lblNombreProducto"></span></h5>
                                        <input type="number" class="d-none" id="stockActual">
                                        <input type="number" class="d-none" id="stockNuevo" name="stockNuevo">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <button id="btnMinus" class="btn btn-outline-dark"><i class="fas fa-minus"></i></button>
                                        <h5 id="lblContador" class="mx-2 mt-2">1</h5>
                                        <input class="d-none" type="number" name="txtContador" id="txtContador">
                                        <button id="btnPlus" class="btn btn-outline-dark"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-dark">Agregar Stock</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
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
    dashboard_Page::sidebarTemplateMovement('inventario.js');
    ?>