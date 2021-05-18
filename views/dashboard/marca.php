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
            <div class="row animate__animated animate__fadeInUp animate__faster">
                <div class="col-lg-12 title">
                    <h1>Marca de productos</h1>
                </div>
            </div><br>
            <!-- Espacio para buscar -->
            <div class="row justify-content-center animate__animated animate__fadeInUp animate__faster">
                <div class="col-12 d-flex justify-content-center">
                    <form class="d-flex w-50" id="search-form" name="search-form">
                        <input class="form-control me-2" type="search" id="search" name="search" placeholder="Buscar... {Nombre de la Marca}" aria-label="Search">
                        <button class="btn btn-outline-dark me-2" id="searchButton">Buscar</button>
                    </form>
                    <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                </div>
                <div class="col-12 justify-content-center d-flex mt-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarMarca" class="btn btn-outline-dark">
                        <i class="fas fa-plus mx-2"></i> Agregar Marca
                    </a>
                </div>
            </div><br>
            <!-- Fila de la tabla -->
            <div class="animate__animated animate__fadeInUp animate__faster row justify-content-center table-responsive">
                <div class="col-lg-8 col-sm-12 d-flex justify-content-center align-items-center">
                    <table class="table">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-rows">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal para admiministrar Marcas -->
            <div class="modal fade" id="administrarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Administrar Marcas</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="administrarMarcas-form">
                                <input class="visually-hidden" type="number" id="idMarca" name="idMarca">
                                <div class="row justify-content-center">
                                    <!-- Columna de información personal -->
                                    <div class="d-flex justify-content-center flex-column col-lg-12 col-sm-12 col-xs-12 widthControles">
                                        <form class="formulario">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="txtMarca" name="txtMarca">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cbEstadoMarca" class="form-label">Estado:</label>
                                                <select id="cbEstadoMarca" name="cbEstadoMarca" class="form-select" aria-label="Default select example">
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <button class="btn btn-outline-dark" id="selecciona3">Actualizar</button>
                                            </div>
                                        </form>
                                    </div><br>
                                </div>
                                <!-- Fin del Contenido del Modal -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar Marcas -->

            <div class="modal fade" id="agregarMarca" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                    class="fas fa-info-circle mx-2"></span>Agregar Marcas</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <form method="post" id="agregarMarcas-form">
                                <input class="visually-hidden" type="number" id="idMarca" name="idMarca">
                                <div class="row justify-content-center">
                                    <!-- Columna de información personal -->
                                    <div class="d-flex justify-content-center flex-column col-lg-12 col-sm-12 col-xs-12 widthControles">
                                        <form class="formulario">
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" id="txtMarca" name="txtMarca">
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <button class="btn btn-outline-dark" id="selecciona3">Agregar</button>
                                            </div>
                                        </form>
                                    </div><br>
                                </div>
                                <!-- Fin del Contenido del Modal -->
                            </form>
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
    dashboard_Page::sidebarTemplateMovement("marcas.js");
    ?>
</body>

</html>
