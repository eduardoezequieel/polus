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
        <div class="container-fluid">
            <!-- Mostrar titulo -->
            <div class="row">
                <div class="col-12 title">
                    <h1>Administrar productos</h1>
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
            <div class="row table-responsive-lg">
                <div class="col-12">
                    <table class="table">
                        <thead class="bg-dark tabla">
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Género</th>
                                <th scope="col">Tipo de producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <img src="../../resources/img/maquillaje.jpg" alt="" width=60px height=60px>
                                        </div>
                                    </div>
                                </th>
                                <td>Short deportiva</td>
                                <td>Caballero</td>
                                <td>Ropa-Short</td>
                                <td>$10.00</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#administrarProductos"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                            <a href="#" data-toggle="modal" data-target="#administrarProductos"
                                                class="btn btn-outline-danger"><i
                                                class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <img src="../../resources/img/maquillaje.jpg" alt="" width=60px height=60px >
                                        </div>
                                    </div>
                                </th>
                                <td>Short deportiva</td>
                                <td>Caballero</td>
                                <td>Ropa-Short</td>
                                <td>$10.00</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#administrarProductos"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                                <a href="#" data-toggle="modal" data-target="#administrarProductos"
                                                    class="btn btn-outline-danger"><i
                                                        class="fas fa-trash-alt tamanoBoton"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <img src="../../resources/img/maquillaje.jpg" alt="" width=60px height=60px >
                                        </div>
                                    </div>
                                </th>
                                <td>Short deportiva</td>
                                <td>Caballero</td>
                                <td>Ropa-Short</td>
                                <td>$10.00</td>
                                <th scope="row">
                                    <div class="row justify-c ">
                                        <div class="col-12 d-flex">
                                            <!-- Button trigger modal -->
                                            <a href="#" data-toggle="modal" data-target="#administrarProductos"
                                                class="btn btn-outline-success"><i
                                                    class="fas fa-edit tamanoBoton"></i></a>

                                            <h5 class="mx-1">
                                                </h1>

                                                <a href="#" data-toggle="modal" data-target="#administrarProductos"
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
            <!-- Fin de la tabla -->
            <!-- Modal para Administrar Productos -->
            <div class="modal fade" id="administrarProductos" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollablemodal-dialog-centered">
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
                            <div class="row">
                                <!-- Columna de la información del producto-->
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <p class="apartado">Información del producto:</p>
                                    <img src="../../resources/img/dashboard_img/separator.png"
                                        class="img-fluid imagenSeparator">
                                    <div class="row">
                                        <!-- Columna 1 de la información del producto-->
                                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 formulario">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombre">
                                                </div><br>
                                                <div class="mb-3 foto">
                                                    <img src="../../resources/img/dashboard_img/imagen.png"
                                                        class="img-fluid imagenUsuario1">
                                                    <button class="btn btn-outline-dark" id="agregarFoto">Agregar
                                                        foto</button>
                                                </div><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Género:</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Dama</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label"
                                                            for="inlineRadio2">Caballero</label>
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
                                                <label for="Tipo de productos" class="form-label">Tipo de
                                                    productos:</label>
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
                                                        <img src="../../resources/img/dashboard_img/separator.png"
                                                            class="img-fluid imagenSeparator1">
                                                        <!-- Botones -->
                                                        <div class="col-12 formulario1">
                                                            <div class="mb-3">
                                                                <label for="selecciona"
                                                                    class="form-label">Selecciona:</label><br>
                                                                <button class="btn btn-outline-dark"
                                                                    id="selecciona">Actualizar</button>
                                                                <button class="btn btn-outline-dark"
                                                                    id="selecciona">Supender</button><br><br>
                                                                <button class="btn btn-outline-dark"
                                                                    id="selecciona1">Activar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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