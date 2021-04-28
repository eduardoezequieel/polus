<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
dashboard_Page::sidebarTemplate('Polus - Dashboard','marca_privado_estilos.css');
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
                <div class="col-lg-12 title">
                    <h1>Marca de productos</h1>
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
                <div class="col-12 formulario0">
                    <br><br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarMarca" class="btn btn-outline-dark">
                        <i class="fas fa-plus"></i> Agregar marca
                    </a>
                </div>
            </div><br>
            <!-- Fila de la tabla -->
            <div class="row justify-content-center table-responsive">
                <div class="col-lg-8 col-sm-12 d-flex justify-content-center align-items-center">
                    <table class="table">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Distribuidora los heroes </td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarMarcas"
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
                            <td>Waves bracelet</td>
                            <th scope="row">
                                <div class="row justify-c ">
                                    <div class="col-12 d-flex">
                                        <!-- Button trigger modal -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#administrarMarcas"
                                            class="btn btn-outline-success"><i class="fas fa-edit tamanoBoton"></i></a>

                                        <h5 class="mx-1">
                                            </h1>

                                            <a href="#" data--bs-toggle="modal" data-bs-target="#administrarInventario"
                                                class="btn btn-outline-danger"><i
                                                    class="fas fa-trash-alt tamanoBoton"></i></a>
                                    </div>
                                </div>
                            </th>
                            </tr>
                            <tr>
                                <td>TLALI</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#administrarMarcas"
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
            <!-- Modal para admiministrar Marcas -->
            <div class="modal fade" id="administrarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <div class="row">
                                <!-- Columna de información personal -->
                                <div class="col-lg-5 col-sm-12 col-xs-12">
                                    <p class="apartado">Información:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <form class="formulario">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre">
                                        </div>
                                    </form>
                                </div><br>
                                <!-- Columna de opciones -->
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <p class="apartado">Opciones:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <!-- Botones -->
                                    <label for="selecciona" id="selecciona" class="form-label">Selecciona:</label>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-dark" id="selecciona3">Actualizar</button>
                                        <button class="btn btn-outline-dark" id="selecciona7">Suspender</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar Marcas -->
            <div class="modal fade" id="agregarMarca" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <div class="row">
                                <!-- Columna de información personal -->
                                <div class="col-lg-5 col-sm-12 col-xs-12">
                                    <p class="apartado">Información:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <form class="formulario">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" id="nombre">
                                        </div>
                                    </form>
                                </div><br>
                                <!-- Columna de opciones -->
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <p class="apartado">Opciones:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <!-- Botones -->
                                    <div id="selecciona8">
                                        <label for="selecciona" id="selecciona" class="form-label">Selecciona:</label>
                                        <button class="btn btn-outline-dark" id="selecciona3">Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
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
