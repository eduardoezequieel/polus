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
                <h1>Tipos de productos</h1>
            </div>
        </div><br>
        <!-- Espacio para buscar -->
        <div class="row animate__animated animate__fadeInUp animate__faster">
            <div class="col-lg-8 formulario2">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn btn-outline-dark me-3" type="submit">Buscar</button>
                    <button class="btn btn-outline-dark" id="btnReiniciar">Reiniciar</button>
                </form>
            </div>
            <div class="col-12">
                <br><br>
                <a href="#" data-bs-toggle="modal" data-bs-target="#agregarTipo" class="btn btn-outline-dark">
                    <i class="fas fa-plus mx-2"></i> Agregar tipo de productos
                </a>
            </div>
        </div><br>
        <!-- Fila de la tabla -->
        <div class="row animate__animated animate__fadeInUp animate__faster table-responsive-lg">
            <div class="col-12">
                <table class="table table-hover ">
                    <thead class="bg-dark tabla">
                        <tr>
                            <th scope="col">Categoría</th>
                            <th scope="col">Subcategoría</th>
                            <th scope="col">Género</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ropa</td>
                            <td>Short</td>
                            <td>Cabellero</td>
                            <th scope="row">
                                <div class="row justify-c ">
                                    <div class="col-12 d-flex">
                                        <!-- Button trigger modal -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#administrarTipo"
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
                        <td>Maquillaje</td>
                        <td>Sombras</td>
                        <td>Dama</td>
                        <th scope="row">
                            <div class="row justify-c ">
                                <div class="col-12 d-flex">
                                    <!-- Button trigger modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#administrarTipo"
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
                            <td>Cuidado facial</td>
                            <td>Mascarillas</td>
                            <td>Dama</td>
                            <th scope="row">
                                <div class="row justify-c ">
                                    <div class="col-12 d-flex">
                                        <!-- Button trigger modal -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#administrarTipo"
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
                        <!-- Inicio del contenido-->
                        <div class="row">
                            <!-- Columna de información -->
                            <div class="col-lg-6">
                                <p class="apartado">Información:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <form class="formulario">
                                    <label for="cbProducto" class="form-label">Categoria:</label>
                                    <select id="cbProducto" class="form-select" aria-label="Default select example">
                                        <option selected>Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select><br>
                                    <label for="sub" class="form-label">Subcategoría:</label>
                                    <input type="text" class="form-control" id="sub"><br>
                                    <label class="form-label">Género:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Masculino</label>
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

        <!-- Modal para agregar Tipo de productos -->
        <div class="modal fade" id="agregarTipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollablemodal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                                class="fas fa-info-circle mx-2"></span>Agregar tipo de producto</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2">
                        <!-- Inicio del contenido-->
                        <div class="row">
                            <!-- Columna de información -->
                            <div class="col-lg-6">
                                <p class="apartado">Información:</p>
                                <img src="../../resources/img/dashboard_img/separator.png"
                                    class="img-fluid imagenSeparator">
                                <form class="formulario">
                                    <label for="cbProducto" class="form-label">Categoria:</label>
                                    <select id="cbProducto" class="form-select" aria-label="Default select example">
                                        <option selected>Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select><br>
                                    <label for="sub" class="form-label">Subcategoría:</label>
                                    <input type="text" class="form-control" id="sub"><br>
                                    <label class="form-label">Género:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Masculino</label>
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
    dashboard_Page::sidebarTemplateMovement();
    ?>
</body>

</html>