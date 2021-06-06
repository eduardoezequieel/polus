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
                <h1>Subcategorías</h1>
            </div>
        </div><br>
        <!-- Espacio para buscar -->
        <div class="row animate__animated animate__fadeInUp animate__faster">
            <div class="col-lg-8 formulario2">
                <form class="d-flex" id="search-form" name="search-form">
                    <input id="search" name="search" class="form-control me-2" type="search" placeholder="Buscar... {Subcategoría, Género}" aria-label="Search">
                    <button class="btn btn-outline-dark me-3" type="submit">Buscar</button>
                    <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                </form>
            </div>
            <div class="col-12">
                <br><br>
                <a href="#" data-bs-toggle="modal" data-bs-target="#agregarTipo" class="btn btn-outline-dark">
                    <i class="fas fa-plus mx-2"></i> Agregar subcategoría
                </a>
            </div>
        </div><br>
        <!-- Fila de la tabla -->
        <div class="animate__animated animate__fadeInUp animate__faster row justify-content-center table-responsive">
            <div class="col-lg-8 col-sm-12 d-flex justify-content-center align-items-center">
                <table class="table">
                    <thead class="bg-dark tabla">
                        <tr>
                            <th scope="col">Subcategoría</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal para admiministrar Tipo de productos -->
        <div class="modal fade" id="administrarTipo" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollablemodal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mx-2"></span>Administrar tipos de productos</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                    <form method="post" id="administrarTipo-form">
                    <input class="visually-hidden" type="number" id="idSubcategoria1" name="idSubcategoria1">
                        <!-- Inicio del contenido-->
                        <div class="row">
                            <!-- Columna de información -->
                            <div class="col-lg-6">
                                <p class="apartado">Información:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <form class="formulario">
                                    <label for="cbProducto" class="form-label">Categoria:</label>
                                    <select id="cbProducto" name="cbProducto" class="form-select" aria-label="Default select example">
                                    </select><br>
                                    <label for="sub" class="form-label">Subcategoría:</label>
                                    <input type="text" class="form-control" id="sub" name="sub"><br>
                                    <div class="mb-3">
                                        <label for="txtGenero" class="form-label">Género:</label>
                                        <select id="txtGenero" name="txtGenero" class="form-select"
                                            aria-label="Default select example" Required>
                                            <option selected>Seleccionar...</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Unisex">Unisex</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <p class="apartado">Opciones:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <!-- Botones -->
                                <div class="col-12 formulario">
                                    <div class="mb-3">
                                        <label for="selecciona" class="form-label">Selecciona:</label><br>
                                        <button class="btn btn-outline-dark" id="selecciona">Actualizar</button>
                                    </div>
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

        <!-- Modal para agregar Tipo de productos -->
        <div class="modal fade" id="agregarTipo" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollablemodal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mx-2"></span>Administrar tipos de productos</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                    <form method="post" id="agregarTipo-form">
                        <!-- Inicio del contenido-->
                        <div class="row">
                            <!-- Columna de información -->
                            <div class="col-lg-6">
                                <p class="apartado">Información:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <form class="formulario">
                                    <label for="cbProducto1" class="form-label">Categoria:</label>
                                    <select id="cbProducto1" name="cbProducto1" class="form-select" aria-label="Default select example">
                                    </select><br>
                                    <label for="sub" class="form-label">Subcategoría:</label>
                                    <input type="text" class="form-control" id="sub" name="sub"><br>
                                    <div class="mb-3">
                                        <label for="txtGenero" class="form-label">Género:</label>
                                        <select id="txtGenero" name="txtGenero" class="form-select"
                                            aria-label="Default select example" Required>
                                            <option selected>Seleccionar...</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Unisex">Unisex</option>

                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <p class="apartado">Opciones:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <!-- Botones -->

                                <div class="col-12 selecciona8">
                                    <div class="mb-3">
                                        <label for="selecciona" class="form-label">Selecciona:</label><br>
                                        <button class="btn btn-outline-dark" id="selecciona">Agregar</button>
                                    </div>
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
    dashboard_Page::sidebarTemplateMovement("subcategoria.js");
    ?>
</body>

</html>