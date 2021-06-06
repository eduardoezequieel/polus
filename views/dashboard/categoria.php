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
        <div class="row animate__animated animate__fadeInUp animate__faster">
            <div class="col-lg-12 title">
                <h1>Categorías  </h1>
            </div>
        </div><br>
        <!-- Espacio para buscar -->
        <div class="row animate__animated animate__fadeInUp animate__faster">
            <div class="col-12">
                <form class="d-flex" id="search-form" name="search-form">
                    <input id="search" name="search" class="form-control me-2" type="search" placeholder="Buscar... {Categoría}" aria-label="Search">
                    <button class="btn btn-outline-dark me-2" type="submit">Buscar</button>
                    <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                </form>
            </div>
            <div class="col-12">
                <br><br>
                <a href="#" data-bs-toggle="modal" data-bs-target="#agregarCategoria" class="btn btn-outline-dark">
                    <i class="fas fa-plus"></i> Agregar Categoría
                </a>
            </div>
        </div><br>
        <!-- Fila de la tabla -->
        <div class="animate__animated animate__fadeInUp animate__faster row justify-content-center table-responsive">
            <div class="col-lg-8 col-sm-12 d-flex justify-content-center align-items-center">
                <table class="table">
                    <thead class="bg-dark tabla">
                        <tr>
                            <th scope="col">Categoría</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para editar categorias -->
        <div class="modal fade" id="editarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollablemodal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mx-2"></span>Editar Categoría</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="editarCategoria-form">
                            <input class="visually-hidden" type="number" id="idCategoria" name="idCategoria">
                            <!-- Inicio del contenido-->
                            <div class="row">
                                <!-- Columna de información -->
                                <div class="col-12">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <div class="bordeDivFotografia">
                                            <div class="divFotografia" id="divFoto">

                                            </div>
                                        </div>
                                        <div id="btnAgregarFoto" class="mt-4">
                                            <button class="btn btn-outline-dark" id="botonFoto"><span
                                                    class="fas fa-plus"></span></button>
                                        </div>
                                        <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario"
                                            accept=".gif, .jpg, .png">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="txtCategoria2">Nombre de la categoría:</label>
                                        <input id="txtCategoria2" name="txtCategoria2" class="form-control m-2" type="text">
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button class="btn btn-outline-dark" type="submit" id="btnActualizar" name="btnActualizar">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fin del Modal -->

        <!-- Modal para agregar categorias -->
        <div class="modal fade" id="agregarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollablemodal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mx-2"></span>Agregar Categoría</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <form method="post" id="agregarCategoria-form">
                            <!-- Inicio del contenido-->
                            <div class="row">
                                <!-- Columna de información -->
                                <div class="col-12">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <div class="bordeDivFotografia">
                                            <div class="divFotografia" id="divFoto1">

                                            </div>
                                        </div>
                                        <div id="btnAgregarFoto1" class="mt-4">
                                            <button class="btn btn-outline-dark" id="botonFoto1"><span
                                                    class="fas fa-plus"></span></button>
                                        </div>
                                        <input id="archivo_usuario1" type="file" class="d-none" name="archivo_usuario1"
                                            accept=".gif, .jpg, .png">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="txtCategoria1">Nombre de la categoría:</label>
                                        <input id="txtCategoria1" name="txtCategoria1" class="form-control m-2" type="text">
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button class="btn btn-outline-dark" type="submit" id="btnCrear" name="btnCrear">Crear</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Contenido del Modal -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fin del Modal -->
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
    dashboard_Page::sidebarTemplateMovement("categoria.js");
    ?>
</body>

</html>